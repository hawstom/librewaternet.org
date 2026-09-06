# LibreWaterNet.org — working guide

**This repository is a website, not the software.** The looped-network modelling it advertises lives
in the EngCalcs repository (`~/webdev/hawsedc.subset/engcalcs`). Never copy code, strings or numbers
across; link, or restate in your own words and mark where the fact came from.

## The authority for every claim is in the OTHER repository

`dev/positioning.md` in EngCalcs is the record: what may be said, what has been struck, and why.
**Read it before writing or editing a sentence of copy.** What follows is the subset that has
already had to be corrected on this very draft, restated here because it is where mistakes land.

### Never a completeness claim against EPANET

Not "does everything EPANET does", not "a full replacement", not a feature table implying parity.
The suite covers a real and growing subset and says so. A claim of completeness is the one a single
counter-example destroys, and the counter-examples exist.

### The phone claim is ONE sanctioned sentence

> And although you of course prefer working on your PC, it works also on a phone in tall mode.

- **"a phone", never "your phone."** Tom chose that himself, *"to be scrupulously honest"*: *a
  phone* is a claim about the software; *your phone* is a promise about a device nobody here has
  seen.
- **"in tall mode" is a narrowing and must not be trimmed.** It names the orientation actually used.
  A reader who turns the phone sideways and finds the drawing surface cramped has not been misled.
- Do not restore *"Try it. We did."* — superseded.

### Never call it a PC application

Tom, 2026-08-24: *"It is not a PC application; it is a web application."* The sentence *"And it is a
PC application, the way EPANET is"* stood on this draft and he struck it. Do not reinstate it, and
do not reach for epanet-js's harder version of the same stance.

### Lead with the invitation, not the comparison

The page's job is to invite people in, not to argue with other software. Where a comparison is
unavoidable, be accurate and generous about the alternative.

### EPANET is silent here

Both LibreWaterNet.org and LibreEPANET.org are owned; only this one gets a page (Tom, 2026-08-24:
*"Keep both, but EPANET is silent."*). Do not build out, promote, or link prominently to the other.
The reasoning is Task 523's: we do not want to inherit EPANET's names, assumptions or associations.

## Before every commit: `sh check.sh`

Six checks now, seconds, and each one exists because it already shipped broken:

- **Every page declares UTF-8 in its first 1024 bytes.** The live server sends
  `Content-Type: text/html` with **no charset**, so a page that does not say so is decoded as
  Windows-1252 and every em dash becomes `â€"` (Tom, 2026-08-25, from the live site). The document
  carrying its own declaration is the portable fix — it holds on that host, on GitHub Pages and from
  a `file://` URL. A server-side `AddDefaultCharset utf-8` is deliberately NOT used: it needs
  `AllowOverride FileInfo`, and where that grant is missing Apache returns 500 for **every** request
  rather than ignoring the line. That trades a live outage for a line the page can carry itself.
- **Every `src` and local `href` resolves.** The images come from the suite's `dev/screenshots/`,
  which is gitignored there and does not travel; a src pointing at one nobody copied is a broken
  image that looks like a page still loading.

**Writing a new page means `<!doctype html>`, `<html lang="en">`, `<head>` with the charset first,
and a viewport line.** The charset goes above the `<title>`, or the title itself is decoded wrongly
before the browser reaches the declaration.

- **A PAGE IS A DOCUMENT, NOT A FRAGMENT** (EDR-01, 2026-09-06). All three pages were served with no
  doctype, no `<html>`, no `<head>` and no `<body>` from the first draft until that review: a
  browser renders that in QUIRKS MODE, legacy box model and all. Nothing looked broken, which is
  exactly why it survived, and it is the most embarrassing line of any technical review of this
  site.
- **The viewport line is the one with a visible cost.** Without it a phone lays the page out at a
  nominal 980px and shrinks it, so the sentence about working on a phone was being read on a page
  that demonstrated the opposite. **And `lang` is not decoration**: the index tells the reader their
  browser has translated this page, and that attribute is the input the browser decides from.
- **Every page needs a description and an `og:image`.** Without them the front door of the project
  pastes into Slack or LinkedIn as a bare URL, and Google writes its own snippet.

### THE TYPE IS THE DEVICE'S OWN, and no font is ever fetched

**Never load a webfont, a script, a stylesheet or an image from another origin. Ever.** These pages
loaded three families from Google Fonts, which put every visitor's IP address in front of a third
party BEFORE they clicked anything, one screen above the sentence *"Nothing here reaches anyone else
unless you turn on the feature that needs it, and each one asks separately"* (EDR-05). The type is a
system stack now: `--font-ui`, `--font-cond` and `--font-serif`, defined once in each page's
`:root`. The drawing-sheet look is carried by weight, spacing and rule work, which is what it should
have been carried by.

Check 5 fails the build on any cross-origin fetch. An outbound LINK is the point of the site and is
fine; what a page FETCHES is the rule.

### The em dash ratchet, in visitor text only

The suite's rule, carried here 2026-09-06 (EDR-16): there were 28 across these three pages and there
are none now, so the ratchet is at zero and check 6 fails on the next one. It is not a claim about
good English. The dash is fine; the reader is not, and a page that leans on it reads as
machine-written whatever it says. Code comments and this file are out of scope on Tom's own
instruction (*"Use it all you want in private. It's lovely."*).

**The apostrophe is typographic in visitor text** (`&rsquo;`, `&ldquo;`/`&rdquo;`), including in the
generated feature list, where `tools/build-features.php` converts it. The Markdown source stays
plain so it is easy to type.

## Writing

- **DO NOT ANNOUNCE THE SITE'S OWN VIRTUES** (Tom, 2026-09-06, on a sentence of the sibling site's:
  *"Methinkest thou boastest too much."*). *Being honest about the edges*, *the list is honest
  rather than complete*, *the honest test is your own network*, *and it is careful to say so* — each
  true, and together the one rhetorical move that makes a reader go looking for what is being
  managed. They are gone from all three pages. An honest page is honest in its declarative
  sentences; the facts here are unusual enough to need no framing. **Write the fact and stop.**
- **A CLAIM CORRECTED ON THE SIBLING SITE IS NOT CORRECTED HERE** (EDR-07, EDR-24). Twice in one
  review: not-epanet.org had already struck *"publish the drawing"* as false and *"no board"* as
  wrong, and both were still standing on this site, which is the one with the traffic. When a claim
  is ruled on over there, grep for it here the same day.
- **Say the thing that survives the next surprise.** The strongest claims here are the ones a future
  discovery cannot falsify. Prefer an honest narrow claim to an impressive broad one.
- **Quote Tom only from a dated first-person source.** Prose in these files is AI-written and must
  never be attributed to him.
- **You have a date, not a clock.** Never write elapsed time ("for months", "an hour later") — it is
  inferred from message position and later readers act on it.

## Pictures

`docs/graphics-plan.md` is the plan. The captures it draws on live in the suite's `dev/screenshots/`,
which is **gitignored there and does not travel**; its `INDEX.md` is tracked and records, per image,
what it shows and whether it may be published. **That publishable judgement is made once, in the
index — do not re-make it per use, and never publish an image the index marks No.** Several are
disqualified only because browser chrome with real names is in frame.

## State

**Live at https://librewaternet.org.** Everything pushed here is published, so a wrong sentence is a
wrong sentence on the public web; run `docs/review.md` over any copy edit before pushing.
