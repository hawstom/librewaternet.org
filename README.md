# LibreWaterNet.org

The public front door for the looped water-network modelling built in
[EngCalcs](https://hawsedc.com/engcalcs/) — free software, GPL v3, no account, no upload.

**This repository holds the site. It does not hold the software.** The calculator suite is its own
repository (`~/webdev/hawsedc.subset/engcalcs` locally), and nothing here should ever duplicate a
line of it.

## What is here

| | |
|---|---|
| `index.html` | The landing page. A **draft** — see below. |
| `screenshots.html` | **Annotated screenshots** — twelve plates, linked from the front door twice (the nav, and beside the hero actions). |
| `img/` | The twelve captures those plates use, 6.6 MB. Copied out of the suite's `dev/screenshots/` drop, which stays the raw material. |
| `docs/graphics-plan.md` | How the page gets its pictures on no budget: what to shoot, in what order, and why. Tom's own shoestring plan, revised with his corrections. |
| `LICENSE` | GNU GPL v3 or later, matching the suite. |

## State: a draft, not a launch

The page has been written and reviewed but nothing is deployed, and the hosting decision is open
(EngCalcs ROADMAP Task 479). `index.html` carries a **placeholder** inline network graphic, not the
real one — `graphics-plan.md` step 1 is what replaces it.

`docs/graphics-plan.md` refers to captures in the suite's own `dev/screenshots/`, which is
gitignored there and does not travel. Its `INDEX.md` **is** tracked and records what each image
shows and whether it may be published. Read that index before reaching for any image — and its
**remake queue**, which lists the shots still wanted and what disqualified each attempt so far.

**Twelve images are committed here and are the exception to that**, deliberately: the ones on
`screenshots.html` have earned a public place, so they live with the page that uses them rather
than in a folder that does not travel. Anything else stays raw material until it earns the same.
**The biggest known gap is a phone** — the sanctioned claim mentions one and no capture exists, so
the narrow-window plate says outright that it is a desktop window and not a phone.

## Before you write one word of copy, read this

**The claims on this page are governed, and they are not governed here.** The authority is
`dev/positioning.md` in the EngCalcs repository, and `CLAUDE.md` beside this file carries the rules
that bite most often. Two that have already had to be corrected on this very draft:

- Never a completeness claim against EPANET.
- The phone claim is one sanctioned sentence, and "a phone" is not "your phone".

Getting one of these wrong is not a style problem. It is the difference between a promise the
software keeps and one it does not.

## Why this is the front door and LibreEPANET.org is not

Both domains are owned. Only this one gets a page.

Tom Haws, 2026-08-24: *"Keep both, but EPANET is silent."* The standing to use the EPANET name —
legal, moral, technical — is unchanged and is why the domain stays bought. What changed is that
having a right to a name is not a reason to lead with it: *LibreEPANET* explains this work in terms
of somebody else's software, and water is the word that is *"fun to use, fun to teach, fun to own,
fun to share."* One is a comparison; the other is an invitation, and the invitation leads.
