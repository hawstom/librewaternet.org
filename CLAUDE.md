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

## Writing

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

Draft. Nothing deployed; hosting undecided (EngCalcs ROADMAP Task 479). The inline `#net` graphic in
`index.html` is a placeholder, not the real one.
