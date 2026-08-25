# The pre-publication review

**Run this over a page before it goes live, and again after any edit to its copy.** It exists
because nine corrections came back from Tom on a published page (2026-08-25) and at least three of
them — a claim we could not have supported, a benefit that dissolved when questioned, and a comma in
a list of two — were findable here in about fifteen minutes.

It is deliberately short. A checklist nobody runs catches nothing.

**Who runs it:** a reviewing agent with no stake in the draft, or the author before pushing. Report
findings as a numbered list against the page, with the exact replacement text for anything you would
change, and mark each one **fact**, **punctuation** or **wording**. Fix facts and punctuation.
**Propose wording; do not silently rewrite somebody's voice.**

---

## 1. Every claim about the software, checked against the software

For each sentence that says the program *does* something, name the evidence before you accept it.
There are only three admissible kinds, and "it sounds right" is none of them:

- **the source** in `~/webdev/hawsedc.subset/engcalcs` — the function, the string key, or the field
  the user actually sees;
- **the closed ledger**, `dev/roadmap-closed-ids.md`, which is what proves a thing shipped;
- **a harness** in `dev/lpn-spike/` or `dev/calc-spike/`, which is what proves it is still true.

Two failure shapes to look for by name, because both have shipped here:

- **Vaporware.** A capability that exists in the engine but that no user can reach. The test is not
  "is it in the code" — it is **can a person set it, see it, or be told about it**. Look for the
  property-box field, the menu row, or the language key.
- **A "not built yet" sentence that has rotted.** These are the first thing on a page to stop being
  true. Extended-period simulation and `.inp` export have BOTH shipped; anything on a page saying
  otherwise is wrong. Check the ledger before writing any absence.

## 2. The governed claims

These are settled and are not open for a fresh judgement while reviewing. `dev/positioning.md` in
the suite is the authority; this list is the subset that has already had to be corrected on a live
page.

| Rule | The failure it prevents |
|---|---|
| **Never a completeness claim against EPANET** — no "does everything", no parity table | One counter-example destroys it, and the counter-examples exist |
| **"a phone", never "your phone"**, and "in tall mode" is never trimmed | A claim about the software, not a promise about a device nobody here has seen |
| **Never "a PC application"** — it is a web application | Tom struck that sentence from this very draft |
| **Extended-period simulation and `.inp` export have shipped** | Three false "not built yet" claims shipped in one day |
| **Four opt-in third-party services, not one and not none** | OSM tiles, Mapbox satellite, Nominatim search, Mapbox terrain. "No third-party request of any kind" is false and anyone with a network tab can check |
| **Our vocabulary, not EPANET's** | A **Text** object is what EPANET calls a Label; our **Label** is its annotation |
| **No competitor in a title, tagline, headline or menu item** | The page's job is the invitation, not the argument |
| **Mobile is never a reason-to-choose-us bullet** | It belongs in the honest-about-the-edges paragraph and nowhere else |

## 3. "Compared to what?"

**Take every sentence that asserts a benefit and ask the question out loud.** If the comparison it
implies is false, absent, or a thing that never existed, the sentence is worse than nothing — it
tells the reader we are counting something that costs nothing.

The worked example, from the live page: *"so you can decide whether it is worth your afternoon
without installing anything."* **There is no install.** Nothing is saved by not doing a thing that
was never required, and the sentence flattered a hesitation instead of answering it. Tom: *"Diving
in saves time."*

Two follow-ups on any surviving benefit sentence:

- **Whose purpose does this serve?** Say what the reader is actually here to do. A feature list is
  read by somebody searching for a thing they need, deciding whether to send us a wish, or measuring
  us against what they use today — not by somebody weighing an afternoon.
- **Does the sentence say WHY?** A toggle without its reason is thin. "You can turn it off" invites
  "why would I?"; "if a big network makes that slow, you can turn it off" is the whole thought.
  Options, defaults and warnings each carry a reason or they read as clutter.

## 4. Jargon

Read every sentence as somebody who has never opened the program. Flag any word that is ours rather
than theirs, and any word borrowed from another trade.

Caught on the live page: **"the transport controls scrub the run"** — two pieces of video-editing
vocabulary in six words. Say what the thing does: *a bar along the bottom plays the run or steps to
any moment in it.*

Standing suspects: transport, scrub, seam, resolver, pointer slop, precache, prefix, entity, token.
Element names that are visible in the interface (junction, reservoir, tank, pipe, pump, valve, text)
are fine, and so is `.inp` — the reader arriving with an EPANET file knows that one.

## 5. Punctuation

When in doubt, the Oxford style guide decides. Three that recur:

- **No comma in a simple list of two.** "Files, and EPANET" is wrong; "Files and EPANET" is right.
  Check every heading, not only the body.
- **The serial comma in a list of three or more.** "Language, licence, and privacy."
- **Semicolons when the items themselves contain commas.** A four-item list where two items carry a
  relative clause is unreadable with commas alone.

Then read the headings on their own, one after another, out of the page. That is how a scanning
reader meets them, and it is where the last one hid.

## 6. Structure, before you call it done

- Every anchor resolves: an `href="#x"` has an `id="x"` on the same page, and a cross-page link
  points at a file that exists. `sh check.sh` covers files and images; anchors are on you.
- Every page declares UTF-8 in its first 1024 bytes (`check.sh`).
- `sh check.sh` exits 0, and its output is quoted in the report.
- **Say plainly that rendering is structurally verified, not visually.** There is no browser here.

## 7. Where a fix belongs

A page has hand-written prose and generated regions, and the difference decides where the edit goes.

- `features.html` between `<!-- BEGIN GENERATED ... -->` and `<!-- END GENERATED ... -->` comes from
  `dev/features-source.md` in the suite, through `dev/scripts/generate_features.php` and then
  `tools/build-features.php`. **Fix a feature sentence there, never here** — editing the page makes
  the two repositories disagree about the same fact, and the next build silently reverts you.
- Everything outside the sentinels is this repository's, and is yours to edit.
- A fact that is wrong in the *software* — a misleading label, a missing reason — is a suite task,
  not a copy edit. Say so in the report rather than papering over it in the prose.
