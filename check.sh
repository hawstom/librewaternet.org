#!/bin/sh
# Everything this repository checks. Run it before every commit:  sh check.sh
#
# It is deliberately tiny. This repo is two static pages and their images, not an application, so
# what it needs is the handful of things that are invisible until somebody else's browser shows them.

fail=0
say() { printf '%s\n' "$*"; }
bad() { fail=1; printf 'FAIL  %s\n' "$*"; }

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

if [ "$fail" = 0 ]; then say 'All checks pass.'; else say ''; say 'BLOCKING FAILURES above.'; fi
exit "$fail"
