# "Mission", "ministry", and the page that is only in English

**Status: PROPOSAL. Nothing here is published.** Tom asked three questions on 2026-08-25 and all
three are about wording, which is his. This file is the draft to accept, reject or rewrite.

> "(1) How about 'free ministry'? How about the words 'mission' and 'ministry' wherever appropriate
> as clarifications of why this is available to everybody? (2) 'Why' or 'Free' or 'Mission'
> section? (3) Browser translated forever? I can accept that. But it might be nice to be
> self-aware where we talk about languages with wording like 'unlike this splash page [or whatever
> we call it: welcome, introduction, etc]'."

---

## 1. Where the two words earn their place, and where they cost more than they buy

The reader's unasked question is **"what's the catch?"** Everything free at this scale has one:
an upsell, a data business, an account, a bait tier. The page currently answers that with a
mechanism — GPL v3, no server, nothing uploaded — and never with a **motive**. A mechanism answers
*how you can't be trapped*. A motive answers *why anyone bothered*, and a reader who has no motive
to attach to a free thing invents one, usually the cynical one.

That is the gap "mission" fills, and it is a real gap, not a decoration.

### Where it clarifies

- **One section, saying why it is free.** See §2. This is the whole of the case for the word.
- **One line in the licence section, at most.** The licence says what cannot be taken away; a
  half-sentence of motive tells the reader why nobody wants to take it away. Optional, and only if
  §2's section is rejected — otherwise it repeats.

### Where it would cost more than it buys — recommended NO

- **The hero.** It already carries *Looking for stakeholders, not for money*, and that line's whole
  strength is that it is unusual and concrete. "Mission" beside it makes it generic; worse, a
  mission plus a "not for money" makes some readers hear *a donation ask is coming*, which is the
  one reading `dev/positioning.md` says to avoid.
- **The nav.** A nav item is a promise about content; "Mission" as a menu word reads as an About
  page, and About pages are what people skip.
- **The languages section.** The motive there is already stated better and more specifically —
  *"the people who most need a free network solver are very often not working in English."* That
  sentence IS the mission, written as a fact. Putting the word on top of it weakens it.
- **The feature list and the screenshots page.** Both are evidence pages. A mission word in an
  evidence page reads as an apology for the evidence.
- **As an adjective, anywhere.** "Our mission-driven translation", "this free ministry's aim". A
  word used in five places stops meaning anything in all five. **The proposal is one section, and
  the discipline is that the word appears in that section and nowhere else on the site.**

### "Ministry" specifically — recommended not on the public page

This is the one place I would push back, and the reason is the audience rather than the sentiment.

1. **In the water sector, "ministry" first means a government department.** Ministry of Water and
   Irrigation, Ministry of Water Resources. The people we most want — utility planners and
   non-profit directors outside the United States — parse that word as *state body* before anything
   else, and "a free ministry" reads to them as a claim about who runs this. That ambiguity is
   worst exactly where the aim is strongest.
2. **Elsewhere it reads as Christian service, and the site is in Arabic, Farsi, Urdu, Pashto,
   Hebrew, Amharic and Khmer.** For some readers that is warmth. For others it is a signal that the
   tool comes with something attached, and in a few countries it is a reason an employer would not
   let it on a work machine. The cost is not distributed evenly, and it falls hardest on the
   low-resource languages the project has spent the most on.
3. **The sentiment survives the word.** Everything "ministry" is meant to convey — given freely,
   for people who cannot pay, no strings — can be said in plain words that every one of those
   readers hears identically. The drafts in §2 try to do exactly that.

**Where "ministry" is entirely right is in the project's own record**, in `dev/positioning.md` or a
commit message, as Tom's own statement of why he is doing this. That is a different audience: it is
us, and it should be written down, because it is the reason the rest holds together.

**If Tom wants it public anyway, it is his word and his project.** The narrowest form I would
suggest is first-person and singular — *"I build it as a ministry"* — because a first-person
statement of motive is read as a person's reason, whereas "a free ministry" is read as a
description of the software, and only the second one misfires.

---

## 2. The section: "Why", "Free", or "Mission"?

**Recommended: a section, yes — and call it `Why`.**

The site's existing section labels are `Who we need`, `What exists`, `Languages`, `Licence`. Every
one of them is short, is about the reader or about the thing, and is not about us. `Why` is the
only one of the three candidates in that register, it is the actual question in the reader's head,
and it is the shortest word on the nav bar.

- **`Free`** — reject. It invites *free as in what?*, which is the licence section's job, so the
  two sections would fight. The word also appears four times on the page already; a heading made of
  it adds nothing.
- **`Mission`** — reject as the *label*, keep as the *content*. It labels the section about us,
  which is the one thing the page has so far succeeded in not being. Nothing stops the heading
  inside from carrying the word.

### Where it sits

The nav today runs: Open the app · Who we need · Feature list · Screenshots · What exists ·
Languages · Licence.

**Recommended position: immediately before `Licence`, after `Languages`.** The three then read as
one argument — *everybody everywhere* (Languages), *why it is free* (Why), *and here is what makes
that permanent* (Licence). Motive, then mechanism. A reader who has scrolled that far is deciding
whether to trust the project rather than the program, and that is precisely what these two answer.

**Alternative, if Tom wants the motive up front:** second section, directly under the hero and above
`Who we need`. It answers the catch question before the ask, which is a defensible order. I prefer
the first because `dev/positioning.md` says the invitation leads, and putting our reasons ahead of
the ask moves the page's opening subject from *you* to *us*.

### Draft copy — three registers, pick one

Each is a complete section. All three avoid "ministry" per §1; the third gets closest to it.

**Draft A — plainest.**

> ### Why it is free
>
> Because the people who need it most cannot buy it. A water system serving ten thousand people in
> a place with no software budget has the same physics as one serving a million, and the engineer
> in front of it deserves the same tools. That is the whole reason this exists, and it is why there
> is no paid tier waiting behind the free one.
>
> It costs us to build and it costs you nothing to use, and both of those are meant to stay true.
> If it is ever worth money to you, the thing to send is not money. Send a bug report, a wish list,
> or an hour of your judgement.

**Draft B — with "mission", once.**

> ### Why it is free
>
> This is a mission, not a product. The people who most need a water network model are very often
> the ones with no budget for one, and a licence fee is the wrong thing to stand between an
> engineer and a system that families drink from. So there is no fee, no paid tier, and nothing
> held back for a version you have to ask about.
>
> That is also why we are asking for stakeholders instead of customers. A product needs buyers. A
> mission needs people who will say what it has to be, and then hold it to that.

**Draft C — nearest to Tom's own sense of the word, without the word.**

> ### Why it is free
>
> Water is the one thing nobody can do without, and the people who look after it are not always the
> people with budgets. This is given, not sold: free to use, free to keep, free to pass on, free to
> fork if we ever let you down. Not free as a promotion, and not free until it grows a price.
>
> It is offered in the same spirit in which people give their working hours to the systems their
> neighbours drink from &mdash; and if that is a strange way to talk about software, it is a very
> ordinary way to talk about water.

I would take **A** for the widest audience and **C** if Tom wants his own motive audible. **B** is
the safe middle and is the one that uses the word he asked about.

---

## 3. The page that is only in English

**This is the sharpest of the three, and the site is currently silent about it.** We claim 27
languages next to a page written in one, and a reader in Bogotá or Bucharest meets that claim
through Google Translate. Saying so costs one clause and buys the credibility of everything around
it, because the reader has already noticed.

### What to call this page

Tom has not settled it. In descending order of my preference:

| Name | For | Against |
|---|---|---|
| **the front door** | Already the site's own word for it — `screenshots.html` links back with "← the front door" — so it is consistent and it is warm | A metaphor, and a metaphor is the first thing machine translation flattens |
| **this welcome page** | Plain, translates cleanly into all 27, and says what it is for | Slightly soft |
| **this introduction** | The most literal and the most translatable | Dry |
| **this page** | Cannot be misread and cannot age | Says nothing |
| **this splash page** | Tom's own first word for it | Industry jargon, and to most readers a splash page is the thing you click past |

**Recommendation: "this welcome page" in the sentence, and keep "the front door" for the link back
from other pages.** One is prose the world reads; the other is an internal signpost.

### Draft clause — four versions

**Clause 1 (recommended), appended to the languages paragraph:**

> — unlike this welcome page, which is in English, and which your browser has translated if you are
> reading it in another one.

**Clause 2, as its own sentence, wry:**

> This welcome page is the exception, and you may already have noticed: it is in English, and
> whatever it reads like in your language, your browser did that and not us.

**Clause 3, shortest:**

> This welcome page is English only; the program is not.

**Clause 4, the one that also answers "forever?":**

> This welcome page is the exception. It is in English and your browser is doing the rest, and we
> would rather admit that than let a translated advertisement stand in for a translated program.

Tom asked *"browser translated forever?"* and said he can accept that. **None of these four promise
otherwise, and I would keep it that way** — a page that says "for now" owes the reader a date.
If he wants the door left open, the honest form is a fact rather than a plan: *"the program came
first, deliberately."*

### And the overclaim next door — this one is a FACT problem, not a wording preference

The sentence the clause would attach to currently reads:

> "What is here is here properly: every label, every tooltip, every warning is translated at the
> back end, not left for your browser to paper over an English program."

**"Every label, every tooltip, every warning" is not true, and it is checkable by anyone who opens
the site in Amharic.** Coverage is a cross: a calculator×language cell is in scope only if the
calculator is core **or** the language is core. Core calculators are the looped-network model,
Manning Pipe Flow and Manning Trapezoidal Channel; core languages are Spanish, Portuguese, French
and Turkish. So Rock Chute Design in Khmer is deliberately English, and its menu entry, title and
description are translated so it can still be found. That is 108 cells of 416, chosen on measured
use, and it is a good decision — it is just not what the sentence says.

Quality varies too, and is recorded: 1.0 English, 0.95 where a native review is on file (Bulgarian
is the only one), 0.85 AI-translated with back-translation and cross-language checks, 0.65 for the
low-resource tier — Amharic, Khmer, Burmese, Pashto, Swahili — which gets less verification by
design.

**Proposed replacement, with the §3 clause folded in:**

> Twenty-seven languages is not every language, and the list here is how far the aim has got, not
> the end of it. What is translated is translated in the program itself &mdash; the labels, the
> tooltips, the warnings &mdash; rather than left for your browser to paper over an English
> program, unlike this welcome page, which is in English and which your browser has translated if
> you are reading it in another one. The network model and the two Manning calculators are
> translated into all twenty-seven; the rest of the suite into the strongest five, and every
> calculator is findable in every language while it waits its turn. The translations are AI-made,
> term by term against a hydraulics glossary, and corrected as people report what reads wrong. How
> good each language is is recorded openly, and the ones with the fewest speakers to check them are
> the ones we are least sure of. Your feedback improves every language, English included, in one
> long global conversation. Right-to-left languages lay out right-to-left.

That paragraph is longer by two clauses and is the version that survives somebody checking.
**It is left unpublished with the rest of this file, because it sits inside the sentence Tom is
reconsidering and splitting the edit in two would give him a paragraph half in his voice and half
in mine.** If he would rather have the fact fixed today and the mission wording decided later, it
is a two-minute edit on its own.
