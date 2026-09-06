#!/bin/sh
# Everything this repository checks. Run it before every commit:  sh check.sh
#
# It is deliberately tiny. This repo is two static pages and their images, not an application, so
# what it needs is the handful of things that are invisible until somebody else's browser shows them.

fail=0
say() { printf '%s\n' "$*"; }
bad() { fail=1; printf 'FAIL  %s\n' "$*"; }

# VISITOR TEXT: the page with its comments, its <style> and <script> blocks and its <code> spans
# removed. **BOTH REMOVALS ARE NON-GREEDY, AND THAT IS THE WHOLE DIFFICULTY.** Written the natural
# way in sed -- a `/<script>/,/<\/script>/d` range, or `s/<!--.*-->//g` over a joined file -- each
# one silently eats the rest of the document when the closing tag shares a line with the opening
# one, or when a page has two comments. A check that deletes its own haystack passes. Caught by
# mutation on the sibling site the day this was written: a planted em dash went unreported.
prose() {
	awk '{ buf = buf $0 "\n" }
	     END { gsub(/<!--([^-]|-[^-]|--[^>])*-->/, "", buf)
	           gsub(/<style[^>]*>([^<]|<[^\/]|<\/[^s])*<\/style>/, "", buf)
	           gsub(/<script[^>]*>([^<]|<[^\/]|<\/[^s])*<\/script>/, "", buf)
	           gsub(/<code>[^<]*<\/code>/, "", buf)
	           print buf }' "$1"
}

# ---------------------------------------------------------------------------
# 1. EVERY PAGE DECLARES UTF-8, AND SAYS SO IN ITS FIRST BYTES
#
# Tom, 2026-08-25, from the live site: every em dash was rendering as "â€"" and the front-door link
# as garbage. The cause was not the files -- they are UTF-8 -- it was that nothing told the browser
# so. **The server sends `Content-Type: text/html` with NO charset**, so the browser falls back to
# its own locale default (Windows-1252 here) and every multi-byte character breaks.
#
# The document declaring its own encoding is the portable fix: it works on that host, on GitHub
# Pages, from a file:// URL and from anybody's laptop. A server-side `AddDefaultCharset utf-8` would
# also work and is NOT done here -- it needs `AllowOverride FileInfo`, and where that grant is
# missing Apache returns 500 for every request rather than ignoring the line. That is a live-site
# outage traded for a line the page can carry itself.
#
# **Within the first 1024 bytes**, which is all a browser reads before it decides. A meta tag after a
# long <head> is a meta tag the browser has already stopped looking for -- and the <title> above it
# would be decoded wrongly regardless, which is exactly the case this check exists to prevent.
for f in *.html; do
	[ -e "$f" ] || continue
	head -c 1024 "$f" | grep -qi 'charset[ ]*=[ ]*.\?utf-8' \
		|| bad "$f declares no UTF-8 charset in its first 1024 bytes"
done

# ---------------------------------------------------------------------------
# 2. EVERY IMAGE A PAGE ASKS FOR IS ACTUALLY HERE
#
# The images are copied in from the suite's dev/screenshots/, which is gitignored there and does not
# travel. A src pointing at one that was never copied is a broken image on a live page, and it looks
# exactly like a page that has not finished loading.
for f in *.html; do
	[ -e "$f" ] || continue
	# NOT `... | while read`: a pipeline's last stage runs in a SUBSHELL, so `bad` set fail=1 in a
	# copy of the shell that then exited, printed FAIL and returned 0. A check that cannot fail the
	# build is worse than no check, because it is trusted. Collected first, looped in THIS shell.
	for src in $(grep -o 'src="[^"]*"' "$f" | sed 's/src="//;s/"//'); do
		case "$src" in
			http*|data:*|//*) continue ;;
		esac
		[ -f "$src" ] || bad "$f references a missing file: $src"
	done
done

# ---------------------------------------------------------------------------
# 3. NO PAGE LINKS TO A LOCAL FILE THAT IS NOT HERE
for f in *.html; do
	[ -e "$f" ] || continue
	# Looped in this shell, not down a pipe -- see the note in check 2.
	for href in $(grep -o 'href="[^"]*"' "$f" | sed 's/href="//;s/"//'); do
		case "$href" in
			http*|\#*|mailto:*|data:*|//*) continue ;;
		esac
		[ -f "${href%%#*}" ] || bad "$f links to a missing file: $href"
	done
done

# ---------------------------------------------------------------------------
# 4. EVERY PAGE IS A DOCUMENT, NOT A FRAGMENT
#
# An editorial review on 2026-09-06 (EDR-01 to EDR-04 in the suite's
# dev/editorial-review-2026-09-06.md) found all three pages served with no doctype, no <html>, no
# <head> and no <body>: a browser renders that in QUIRKS MODE, with the legacy box model and legacy
# line-height rules. Nothing looked broken, which is why it survived from the first draft. The
# viewport line is the one with a visible cost -- without it a phone lays the page out at a nominal
# 980px and shrinks it, on the site whose own sentence is that the software works on a phone.
#
# `lang` is not decoration either: the index says the browser has translated this page if the reader
# is not reading English, and this attribute is the input that decision is made from.
for f in *.html; do
	[ -e "$f" ] || continue
	head -c 200 "$f" | grep -qi '<!doctype html>' || bad "$f does not open with <!doctype html> (quirks mode)"
	grep -qi '<html lang="[a-z-]*"' "$f" || bad "$f has no <html lang> -- browser translation and screen readers both read it"
	grep -qi '<meta name="viewport"' "$f" || bad "$f has no viewport meta -- a phone will lay it out at 980px and shrink it"
	grep -qi '<meta name="description"' "$f" || bad "$f has no meta description -- Google writes its own snippet from a page that is mostly a form"
	grep -qi '<meta property="og:image"' "$f" || bad "$f has no og:image -- pasted into Slack or LinkedIn it is a bare URL"
done

# ---------------------------------------------------------------------------
# 5. NOTHING IS FETCHED FROM ANYBODY ELSE
#
# These pages used to load three families from Google Fonts, which put every visitor's IP address
# in front of a third party BEFORE they clicked anything -- one screen above the sentence "Nothing
# here reaches anyone else unless you turn on the feature that needs it, and each one asks
# separately." The type is a system stack now. The rule is not about fonts: it is that this site
# makes no request a visitor did not ask for, which is the one claim on it a sceptical reader can
# test in a browser's network pane in about four seconds.
#
# An outbound LINK is fine and is the point of the site. This looks only at what a page FETCHES.
for f in *.html; do
	[ -e "$f" ] || continue
	grep -o '<link[^>]*rel="stylesheet"[^>]*>' "$f" | grep -q 'http' \
		&& bad "$f loads a stylesheet from another origin"
	grep -o '<link[^>]*rel="preconnect"[^>]*>' "$f" | grep -q 'http' \
		&& bad "$f preconnects to another origin"
	grep -o '<script[^>]*src="http[^"]*"' "$f" | grep -q . \
		&& bad "$f loads a script from another origin"
	grep -o '<img[^>]*src="http[^"]*"' "$f" | grep -q . \
		&& bad "$f loads an image from another origin"
	grep -o '@import[^;]*http' "$f" | grep -q . \
		&& bad "$f @imports from another origin"
	grep -oE 'url\(["'"'"']?https?:' "$f" | grep -q . \
		&& bad "$f fetches a CSS asset from another origin"
done

# ---------------------------------------------------------------------------
# 6. THE EM DASH RATCHET, IN VISITOR TEXT ONLY
#
# The suite's own rule, carried here on 2026-09-06 (EDR-16). It is not a claim about good English:
# the dash is fine, the reader is not, and a page that leans on it reads as machine-written whatever
# it says. There were 28 across these three pages and there are none now, so the ratchet is at zero
# and the next one fails the build.
#
# **Scope is visitor text.** Code comments, this file, and commit messages are out of scope on Tom's
# own instruction ("Use it all you want in private. It's lovely."), so <style>, <script> and HTML
# comments are stripped before counting. A dash separating two names in a <title> is a typographic
# separator and carries none of the tell; there is none here, and if one arrives, exempt it here
# rather than deleting this check.
for f in *.html; do
	[ -e "$f" ] || continue
	n=$(prose "$f" | grep -o -e '—' -e '&mdash;' | wc -l)
	[ "$n" = 0 ] || bad "$f has $n em dash(es) in visitor text; the ratchet is at zero"
done

if [ "$fail" = 0 ]; then say 'All checks pass.'; else say ''; say 'BLOCKING FAILURES above.'; fi
exit "$fail"
