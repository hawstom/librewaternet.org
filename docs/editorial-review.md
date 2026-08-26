# Editorial review — index, screenshots, features

**Commissioned 2026-08-25**, after Tom read a caption on `screenshots.html`:

> "This, the menu is beneath the button that opened it, sounds embarrassingly vacuous… Please spawn
> a literary editor agent to review lwn and report such vacuous truisms and other weak writing."

**Nothing in this file has been applied.** Wording is Tom's. Every replacement below is a proposal,
and several are marked *needs a fact check first*. The pages are unchanged.

**What was examined:** every sentence of prose and every list item on `index.html`,
`screenshots.html` and `features.html` — about **205 units of copy**. **31 are flagged.** The other
174 range from serviceable to very good, and the best of them are named at the end so the standard
is visible rather than implied. The prose on these three pages is, on the whole, better than the
average software site; the faults are concentrated and mostly cheap to fix.

**Where a fix belongs** (`docs/review.md` §7): findings marked **[source]** are inside the generated
region of `features.html` and must be fixed in `dev/features-source.md` in the suite, never on the
page. Everything else is this repository's.

---

## 0. Factual — decided on different grounds from the rest

### F1. `features.html` disagrees with its own source, and the published version is the wrong one **[source]**

The page says:

> Twenty-seven languages, across the whole suite and not only its menus.

`dev/features-source.md` line 116 says something else entirely, and something true:

> Twenty-seven languages, and every word is evaluated for translation: the network model and the two
> Manning calculators go into all of them, the rest of the suite into Spanish, Portuguese, French,
> and Turkish…

Two problems, and the second is worse than the drift.

1. **The page and the source disagree**, so the next `tools/build-features.php` silently reverts
   whatever is on the page. That is exactly the failure `docs/review.md` §7 warns about.
2. **The published sentence is backwards.** Under the coverage cross (suite `CLAUDE.md`), a cell is
   in scope iff the calculator is core *or* the language is core. So the *menus* — every calculator
   findable by name — are the part that goes into all 27, and the *bodies* of 13 calculators are the
   part that does not. The sentence claims the reverse. `index.html` states this correctly; the two
   pages currently contradict each other on the project's deepest claim.

**Proposed** — restore the source line, tightened, and let the build overwrite the page:

> Twenty-seven languages, in the working interface and not only in the menus. The network model and
> the two Manning calculators are in all of them; the rest of the suite is in Spanish, Portuguese,
> French, and Turkish, and every calculator is findable by name in every language while it waits its
> turn.

### F2. "twelve more, annotated" — there are eleven

`index.html`, hero figcaption. `screenshots.html` holds fourteen plates; the hero and its strip show
three of them (0028, 0007, 0026), all three of which appear again on that page. Fourteen minus three
is eleven.

**Proposed:** `eleven more, annotated`.

### F3. Two pages disagree about how many examples ship **[source]**

`screenshots.html` Plate 1: *"Seven worked examples, open on arrival."* Correct — `examples/` holds
seven. `features.html`: *"An examples library that opens Net1, Net2, Net3, Elm Street Center and a
Net3 placed on the world"* — five, omitting the two Basic examples, which are the two a beginner
would actually open first.

**Proposed:** *"An examples library that opens in one click: two starter networks, EPA's Net1, Net2
and Net3, Elm Street Center, and Net3 placed on the real world."*

### F4. "eight ways of choosing where the breaks fall" — *needs a fact check* **[source]**

`js/lpn-ramps.js` holds eight `MODES`, but `modesFor()` drops `manual` deliberately ("SHOWN AND
STORED, NEVER OFFERED"), and `pressure` appears only while pressure is the quantity being coloured.
A user therefore sees six, or seven. Eight is defensible only if hand-typing the breaks counts as a
"way of choosing", which is a stretch of the same kind this review is about.

**Proposed:** *"…three to seven classes, six ways of placing the breaks — seven when you are
colouring by pressure — with the numbers yours to overrule, and 41 colour ramps."*

### F5. `.net` is supported and the feature list does not say so **[source]**

Not an error, a missed fact. `js/lpn-net.js` converts EPANET's binary `.net` — and the code comment
explains why that matters: *"what a real user's models are… Telling them to find File > Export >
Network first is a step most do not know exists."* `index.html` mentions `.net`; `features.html` says
only `.inp`. The list is the page a person searches for the thing they need.

**Proposed:** *"Opens EPANET files — the `.inp` text format and the binary `.net` that EPANET's own
Save produces — takes the part it supports, and reports every difference instead of dropping it
quietly."*

---

## 1. Vacuous truisms — the commissioned target

### V1. The caption that prompted the review — `screenshots.html`, Plate 13

Current:

> **The whole menu, under the thumb that opened it**
> On display in one frame: the Water menu open directly beneath its own button, carrying Settings,
> Libraries, Profile, Tables, Scenarios, Calculate, and the EPANET run report; the network drawn at
> street level over satellite imagery behind it; the flow colour key down the right-hand side; and
> the units, the friction method, and the scenario stated along the bottom.

Four faults, and they compound.

- **The truism.** A menu appears under its button. The opposite sentence — *"the menu appeared
  somewhere else entirely"* — is not a thing any product has ever said, so its negation carries no
  information. Presenting it as an observation implies we think it is an achievement, which reads
  either as padding or as a confession that it once did something else.
- **The insider's tell.** It once did. The caption is quietly celebrating a fixed defect; it is
  written from the author's memory of the bug rather than from the reader's experience of the
  software. **What a reader would have to already know:** that the menu formerly floated detached
  mid-canvas.
- **"On display in one frame:"** is a stage direction. It asks the reader to admire how much was
  fitted in, which is again an achievement only to someone who remembers it not fitting.
- **Shape.** Sixty words, four semicolon-joined clauses, and every one of them an inventory of
  chrome. Nothing in it says what a person can *do*. The main clause is a colon and a list.

**Proposed:**

> **Everything is still there, at phone width**
> The Water menu on a phone, carrying Settings, Libraries, Profile, Tables, Scenarios, Calculate,
> and the run report — over the network drawn at street level on satellite imagery, with the flow
> colour key beside it and the units, the friction method, and the scenario along the bottom.

And the note reordered so the sanctioned sentence does not open on a dangling *"And"*:

> It is the same program rather than a cut-down one — the same menu over the same drawing — with the
> page's own headings dropped and the menu wording reduced to icons to make the room. And although
> you of course prefer working on your PC, it works also on a phone in tall mode.

The phone sentence itself is untouched, and moving it is the whole of the proposal about it.

### V2. "and it stays there" — `index.html`, Publish

> Labels you control. Drag one where you want it, set what it says, and it stays there, with leader
> lines that follow.

**Same species as V1, and it costs more, because it is on the front door in the one paragraph that
carries the project's real differentiator.** A label staying where you dragged it is what dragging
means. It is remarkable only against a map that auto-hides labels at report zoom and offers no
override — which is `dev/positioning.md` §4, a document the reader has not read. Read cold, this
sentence spends the differentiator's slot on nothing.

The claim worth making is the one about *zoom*: the label survives the operation that would
otherwise remove it.

**Proposed:**

> Labels you control. Drag one where you want it and say what it says; it is not hidden or
> rearranged when you zoom out to report scale, and its leader line follows it.

*(Needs a check that a placed label is genuinely never auto-hidden at any zoom — the auto-placer's
shedding behaviour in `js/lpn-collide.js` applies to labels it placed. If a dragged label can still
shed values, narrow the sentence.)*

### V3. "written only when you ask" — `screenshots.html`, Plate 11

> the page explains what saving means here: the file is written only when you ask, and the browser
> asks its own permission first.

Save writing when you press Save is what Save is. The actual news — and it is good news — is that
the project connects to a real file on the user's own disk through the browser's permission prompt,
and that there is no other copy anywhere. `lpn_file_saveas_tip` is the evidence: *"This project
connects to that file, and Save writes to it from then on."*

**Proposed:**

> The first time you save, the page explains what saving means here: you pick a file on your own
> disk, the browser asks your permission before it writes there, and from then on Save goes to that
> file. There is no other copy, because there is nowhere else for one to be.

### V4. "Cancel puts your original numbers back exactly" — `screenshots.html`, Plate 5

Cancel undoing a thing is what Cancel is. The word doing the work is *exactly*, and it is invisible:
it means the coordinates do not come back rounded through a conversion, which is a genuine
achievement of the suite's whole numbers-are-yours rule and completely opaque to a reader.

**Proposed:**

> This is the step that puts it on the Earth — nothing moves until you confirm, and if you cancel,
> your coordinates come back as the numbers you typed rather than as those numbers converted and
> converted back.

### V5. "A Help menu specific to this calculator." — `features.html` **[source]**

A help menu is table stakes; "compared to what?" has no answer. *"this calculator"* also has no
referent on a page that is a list. Either say what is in it or delete the line — a 53-item list can
afford to lose one.

**Proposed** *(needs a check of what the menu actually holds)*: *"Help written for the map editor
itself — the drawing tools, the menus, and what each property means."*

### V6. "still empty" — `screenshots.html`, Plate 14

> with the field for the new value sitting above them, still empty.

Why would a reader care that a field has not been filled in? *Still empty* means "nothing has been
replaced yet", which matters only to whoever took the screenshot. Cut the two words; the sentence is
better without them.

### V7. "steering still changes where it goes" — `index.html`, stakeholders

> What the project is short of is people who will steer it; and it is early enough that steering
> still changes where it goes.

Steering changes direction by definition. The intended claim — a good one — is that the decisions
are still open. The semicolon before *and* is also a comma wearing a hat.

**Proposed:**

> What the project is short of is people who will steer it, and it is early enough that the
> decisions steering would settle are all still open.

### V8. Kept deliberately: "Right-to-left languages lay out right-to-left."

Reads like a truism and is not one — in software, an RTL layout is work most products skip. **Do not
cut it.** Its only fault is position: it lands at the end of a paragraph about translation *quality*,
where it is a non sequitur. Move it to the end of the first language paragraph, beside the other
claims about what is translated.

---

## 2. The insider's sentence

### I1. The worst passage on the site — `screenshots.html`, closing block

> They are a selection. Fourteen frames chosen from a larger set, and the ones left out were left
> out for a reason: nearly all of them show a rough edge we have since fixed, and publishing one of
> those would be showing you a bug that is no longer there.
>
> So take them as an invitation to look, not as proof of anything.

This costs more than anything else in this review, and it is three faults in one paragraph.

- **It answers a question nobody asked.** No reader wonders why there are fourteen rather than
  twenty. Raising it makes the number feel defended.
- **It plants a bug where there was none.** The reader learns that most of our screenshots showed
  defects. That is a fact about our editorial process, and it lands as a fact about the software.
  **What the reader would have to already know:** that `dev/screenshots/INDEX.md` records a
  publishable judgement per capture, and why most captures fail it.
- **"not as proof of anything" contradicts the standfirst of the same page**, which says *"Nothing
  here is a mock-up: every frame is the program running in a browser, and the numbers on them are
  numbers it worked out."* That sentence is the page's whole argument, and this one retracts it in
  the last paragraph. If they are not proof, the standfirst was overclaiming; if the standfirst is
  right, this is false modesty that undoes it.

And the last line repeats a failure `docs/review.md` §3 already caught and Tom already ruled on:

> The honest test is your own network, and it costs you a few minutes.

Tom's correction was *"Diving in saves time."* This is the same shape — framing use as an
expenditure and flattering a hesitation — in smaller words.

**Proposed, replacing the whole block:**

> ### What these pictures are not
>
> They are a selection: fourteen frames out of a larger set, one for each different thing the
> program does, and no attempt at a tour.
>
> The software is free, it runs in your browser, and nothing you draw leaves your machine except
> through a feature you turn on, which asks first. Open one of the examples, or a file you already
> know the answer to, and you will learn more in ten minutes than this page can tell you.

### I2. "a named gap, not a quiet one" — `screenshots.html`, Plate 10

> Simple controls are read and honoured; rule-based control is a named gap, not a quiet one.

This defends against an accusation the reader has not made — that we hide our gaps — and it does it
in our own internal vocabulary ("reports every difference rather than dropping silently"). A reader
meeting *"a named gap, not a quiet one"* has to reconstruct the argument it is the conclusion of.

The note also carries five unrelated facts in two sentences: tanks, patterns, the transport bar, which
engine runs it, and the missing feature. That is a paragraph's work done in a caption.

**Proposed:**

> Tanks fill and drain, demands follow their patterns, and the bottom pane plays the day back or
> steps to any moment in it. The run itself is the EPANET engine's. Rule-based control is the one
> kind of control we do not read yet; it is on the short list of what we lack.

### I3. "Standard gravity throughout" — `features.html` **[source]**

Meaningless to anyone outside the project. It is the residue of a task that unified a constant, and
it reads to an engineer as either trivially obvious or faintly alarming — why would you mention it?
The second half of the line is the real feature and can stand alone.

**Proposed:** *"Where the built-in solver and the EPANET engine disagree, the page tells you by how
much rather than picking one and staying quiet."*

### I4. "not something that slipped past us" — `index.html`, languages

> Every word is evaluated for translation: where a word is still in English, that is a decision on
> the record and not something that slipped past us.

Defensive, and it argues with a reader who has not spoken. The suite's own rule is that an *absent*
key is the correct untranslated state — which makes "every word is evaluated" a broader claim than
the coverage cross supports, since an out-of-scope cell is precisely a word not yet evaluated.

**Proposed:** *"Where a word is still in English, that is on the record as a decision, with the
reason it has not been reached yet."* — or cut the sentence; the paragraph is strong without it.

### I5. "shows real progress" — `features.html` **[source]**

*Real* is empty emphasis, and it smuggles in a joke about progress bars that lie. The parenthesis
also buries the main clause before the reader reaches the verb.

**Proposed:** *"A Run button that reports where it has got to, what it finished, and the engine's own
report of the run — optional, since answers can follow your edits instead."*

---

## 3. Unearned claims

### U1. "with no install and no upload" — `features.html`, Solving it **[source]**

Two faults at once.

- **"compared to what?"** is the exact failure `docs/review.md` §3 documents with Tom's own
  correction: nothing is saved by not doing a thing that was never required.
- **The same page says the opposite twice.** *"Install it from the browser you already have"* (The
  calculators) and *"It installs on a desktop or a phone as an app of its own, icon and all."*
  (Language, licence, and privacy). A reader scanning the list meets all three.

**Proposed:** *"A looped network solved by the global gradient method, in the page itself, with
nothing uploaded and no server involved."*

### U2. "There is nothing to buy here **for now**" — `index.html`

Two words that undo the pillar. *For now* says a price is coming; on a page whose banner is *Looking
for stakeholders, not for money*, it turns the ask into a soft launch. `dev/positioning.md` §1: *"an
ask that reads as fundraising with the ask hidden is worse than no ask."*

**Proposed:** *"There is nothing to buy here, no donation button, and everything you see is yours and
ours together."*

### U3. "the one a client understands on sight" — `screenshots.html`, Plate 7

A superlative with no comparison behind it, sitting immediately after a sentence that already made
the point well. The preceding clause — *"the drawing that answers 'why is the pressure low up
there'"* — is doing all the work.

**Proposed:** *"The profile is the drawing that answers 'why is the pressure low up there', and it
answers it to somebody who has never read a model."*

### U4. "A narrower window loses nothing" — `screenshots.html`, Plate 9

The headline is contradicted three sentences later by its own note: *"Narrower than this it does
hide things."* The honesty is welcome; the headline should be scoped so the note confirms it instead
of correcting it.

**Proposed:** *"At this width, nothing is hidden."*

---

## 4. Rhythm, shape and parallelism

### R1. The noun pile — `index.html`, honest-about-the-edges

> development has followed an informal path of assumed most critical features

Six nouns and adjectives in a row with no verb between them; *"an informal path of assumed most
critical features"* cannot be parsed on one pass. It is also the one paragraph on the page where a
reader is being asked to trust us, so opacity costs double.

**Proposed:**

> Being honest about the edges: we have built what looked most critical to us, informally, and we do
> not know how big the gap is between this and EPANET. The gaps we do know: a run over time goes
> through the EPANET engine, and the built-in solver has no time dimension. Rule-based controls and
> water quality modelling are not built. And although you of course prefer working on your PC, it
> works also on a phone in tall mode.

### R2. The hundred-word sentence — `index.html`, languages

> What is translated is translated in the program itself — the labels, the tooltips, the warnings —
> rather than left for your browser to paper over an English program, unlike this welcome page,
> which is in English, and which your browser has translated if you are reading it in another one.

The self-aware clause is deliberate and stays. Its *attachment* is the fault: *"unlike this welcome
page"* hangs off *"an English program"*, so on first reading the welcome page seems to be an example
of the thing being criticised. Give it its own sentence and it becomes the wry aside it was meant to
be.

**Proposed:**

> What is translated is translated in the program itself — the labels, the tooltips, the warnings —
> rather than left for your browser to paper over an English program. This welcome page is the
> exception: it is in English, and your browser has translated it if you are reading it in another
> one. Right-to-left languages lay out right-to-left.

### R3. The list that is out of order with itself — `index.html`, What exists

> It solves, it draws, and it publishes a map you can hand to somebody.

The three cards directly beneath are **Draw, Solve, Publish**, in that order. The sentence
introducing them lists Solve, Draw, Publish. A reader's eye moves from the sentence to the cards and
has to re-sort.

**Proposed:** *"It draws, it solves, and it publishes a map you can hand to somebody."*

### R4. Non-parallel list items — `features.html` **[source]**

Within a single section the items change grammatical person. "Files and EPANET" is the tightest case:

> Opens EPANET `.inp` files… *(verb-initial, implied subject "it")*
> An import note is filed on the element it concerns… *(noun-initial, passive)*
> Writes `.inp` files back out… *(verb-initial)*
> Projects are `.lwn` files… *(noun-initial)*
> An examples library that opens… *(noun-initial, no main verb at all)*

The last is a sentence fragment: *"An examples library that opens Net1…"* has a relative clause where
its predicate should be. The same wobble runs through "The calculators", which mixes imperatives
(*Install it…*, *Name a calculation…*) with declaratives.

This does not need 53 rewrites. **Pick one shape per section and hold it** — noun-initial reads best
for a scannable list, since the first word is the thing being searched for.

### R5. Dangling modifier — `features.html` **[source]**

> A drawing toolbar — junction, reservoir, tank, pipe, pump, valve and text — placed by clicking the
> map.

As written, the toolbar is placed by clicking the map.

**Proposed:** *"A drawing toolbar — junction, reservoir, tank, pipe, pump, valve and text — each one
placed by clicking the map."*

### R6. Category error — `features.html` **[source]**

> Text, symbols and pipes are three independent screen sizes

Things are not sizes.

**Proposed:** *"Text, symbols and pipes size independently on screen, so a drawing reads the same at
every zoom."*

### R7. "is is" — `index.html`, languages

> How good each language is is recorded openly

**Proposed:** *"The quality of each language is recorded openly, and the ones with the fewest
speakers to check them are the ones we are least sure of."*

### R8. One word three times in thirty — `screenshots.html`, Plate 10

*"each marked as understood"* appears in the caption, in the `alt` text, and *understood* again in
the heading. It is also the wrong word: the news is not that the program understood them, it is that
it carries them into the run.

**Proposed heading:** *"Controls, read and honoured."*
**Proposed caption:** *"Six simple controls out of a real model — `Link 10 OPEN AT TIME 1`,
`Link 335 OPEN IF Node 1 BELOW 17.1` — each one recognised and carried into the run."*

### R9. Limp passive — `index.html`, Non-profit directors

> Water systems get designed and run by organisations without a software budget.

*Get designed* is weak where the surrounding prose is not, and the sentence buries its subject at the
end.

**Proposed:** *"Water systems are designed and run by organisations with no software budget."*

### R10. The one weak heading — `index.html`

Read alone, the headings are strong: *World class and world owned.* / *Four kinds of person we are
looking for* / *It is not a proposal. It runs.* / *The people who need it most cannot buy it* /
*World owned means yours to keep.*

The exception is **"Everybody everywhere is the aim."** The inversion puts *the aim* — the least
interesting word — in the stress position, and it is the only heading that describes an intention
rather than a fact. The section under it is about a fact.

**Proposed:** *"Everybody everywhere, in twenty-seven languages."*

### R11. Filler — `screenshots.html`, dek

> Fourteen pictures of the software doing real work, each with what it is showing and why that
> matters.

*and why that matters* promises what every caption on the page already promises. *Real* is doing
nothing that *doing work* does not already do.

**Proposed:** *"Fourteen pictures of the software at work, each with what it is showing and why it
is there."*

### R12. Serial comma, inconsistent site-wide *(punctuation)*

`docs/review.md` §5 mandates the serial comma. The site uses it about half the time.

**With:** "Settings, Libraries, Profile, Tables, Scenarios, Calculate, and the EPANET run report" ·
"the units, the friction method, and the scenario" · "Spanish, Portuguese, French, and Turkish" ·
"Language, licence, and privacy".

**Without:** "Junctions, reservoirs, tanks, pipes, pumps and valves" (`index.html`, and again in
`features.html`) · "junction, reservoir, tank, pipe, pump, valve and text" · "Text, symbols and
pipes" · "moved, scaled and rotated" · "Prefixes, suffixes and a separator" · "pressure, flow,
velocity or head loss" · "menus, settings, the colour key, the status bar and the tooltips".

Whichever house style Tom prefers, one of the two lists needs to move. Note that the element list
*"junctions, reservoirs, tanks, pipes, pumps and valves"* appears identically in three places, so it
is one decision applied three times.

---

## 5. What to leave alone

**A review that flags everything has flagged nothing.** The following is a partial list of what is
already working, and the first item is the standard the rest of the site should be measured against.

**The best writing on the site**, `index.html`, Why:

> A water system serving ten thousand people has the same physics as one serving a million, and the
> engineer in front of it deserves the same tools. Software budgets are not handed out the way water
> problems are.

Two sentences. The first is a fact about hydraulics that turns into a claim about justice without
announcing that it is doing so; the second is a joke, an argument and a policy in eleven words. No
adjective in either is decorative. **Nothing should be changed here, including the punctuation.**

Close behind, and each worth keeping exactly as written:

- *"A wish list is a specification."* — the shortest sentence on the site and the most useful. It
  reframes the reader from petitioner to contributor in five words.
- *"Send the model and what you expected; that is a complete report."* — answers the question a
  would-be bug reporter actually has, which is "how much do you need from me?".
- *"Labels place themselves. Where there is no room, a label sheds values in the order you chose
  instead of disappearing whole."* — the project's real differentiator, stated without naming a
  competitor and without needing one. This is what V2 was reaching for and missed.
- *"Colour limits hold still across a run, so a colour means the same thing at every step."* — a
  small feature and its reason, in one breath. The model for every other line in that list.
- *"Projects are `.lwn` files — JSON inside, on your own disk, readable without us."* — *readable
  without us* is the whole licence argument compressed into three words.
- *"Most of the work in a report is not the solve. It is making a page a reviewer can read without
  you standing next to them."* — the best caption on `screenshots.html`, and the one that knows what
  its reader's day is like.
- *"The fastest way to find out whether a tool is any good is to watch it solve something you already
  know the answer to. That is what these are for."* — earns the examples gallery completely.
- *"A list like this reads as though somebody has surveyed the whole territory. Nobody has."* — the
  honest-about-the-edges register at its best: disarming without being apologetic. Compare it with
  I1, which attempts the same move and instead sounds defensive; the difference is that this one
  admits ignorance while that one confesses process.
- *"It is not a proposal. It runs."* — four words carrying an entire section.
- *"Pipe labels lie along their pipe, the way a map draws a street name."* — the only simile in the
  feature list and it is the right one.
- *"Stated here rather than on a policy page, because this is the sentence you need before you click,
  not after."* — the privacy paragraph earns its length, and this line explains why it is where it
  is.

**The pattern worth naming.** Every sentence in this section says something whose opposite is a
sentence somebody could write. That is the whole test, and it is the test V1 through V7 fail.

---

## Summary

| | Count |
|---|---|
| Copy examined | ~205 sentences and list items |
| Flagged | 31 |
| Factual or self-contradictory | 5 |
| Vacuous truisms | 7 (one kept deliberately) |
| Insider's sentences | 5 |
| Unearned claims | 4 |
| Rhythm, shape, punctuation | 12 |
| Fixes belonging in `dev/features-source.md` | 9 |

**If only three things are changed**, they should be F1 (the two pages contradict each other about
27 languages, and the build will revert whichever is edited on the page), I1 (the closing paragraph
of `screenshots.html`, which tells a reader that most of our screenshots showed bugs and then
retracts the page's own argument), and V1 with V2 together — the menu caption Tom caught and the
label sentence on the front door, which is the same fault in the more expensive place.
