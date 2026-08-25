<?php
/**
 * build-features.php -- put the suite's feature list onto features.html.
 *
 * THE SOURCE OF TRUTH IS IN THE OTHER REPOSITORY. `dev/features.md` in EngCalcs is itself
 * generated, from `dev/features-source.md`, by `dev/scripts/generate_features.php`. Nothing here
 * writes a feature sentence; this script only transforms them into the markup this page uses, so
 * the list cannot drift by somebody retyping it.
 *
 * Run it after the feature list changes over there:
 *
 *     php tools/build-features.php [path/to/engcalcs/dev/features.md]
 *
 * It rewrites only what sits between the sentinel comments in features.html. The page's design,
 * its framing prose and its honest-edges note are hand-written and are never touched.
 *
 * TWO DEPARTURES FROM THE SOURCE, both deliberate, both declared below rather than done quietly:
 *
 *  - RELOCATE. The phone sentence is a sanctioned claim word for word, but dev/positioning.md §3
 *    keeps mobile out of "a list of reasons to choose us" and gives it one home: the paragraph
 *    that is honest about the edges. A features page is exactly such a list, so the sentence is
 *    moved into that note VERBATIM rather than dropped or reworded.
 *  - OVERRIDE. One sentence understates what the program does and contradicts index.html, which
 *    was corrected against the code on 2026-08-25. Replacing it here keeps the two pages from
 *    disagreeing with each other in public. An override is a debt: the honest fix is upstream, in
 *    features-source.md, and this map should shrink to nothing.
 *
 * Both are keyed by the task IDs the source cites, so a reworded sentence still lands correctly
 * and a DELETED one stops the build instead of vanishing silently.
 */

$src = $argv[1] ?? __DIR__ . '/../../hawsedc.subset/engcalcs/dev/features.md';
$page = __DIR__ . '/../features.html';

/** Sentence sent to the honest-edges note instead of the list. Key: the source's cited IDs. */
$RELOCATE = array('486');

/** Sentence replaced. Key: cited IDs. See the docblock -- each entry needs a reason. */
$OVERRIDE = array(
	// Source says "four breaks, equal intervals or equal counts, three ramps". The catalogue in
	// js/lpn-ramps.js holds 41 ramps in three Brewer families, published at 3 to 7 classes, with
	// more break rules than two. index.html already says 41.
	'384, 327' => 'Colour the map by any value, from one control: three to seven classes, several '
		. 'ways of choosing where the breaks fall, and 41 colour ramps.',
);

$md = @file_get_contents($src);
if ($md === false) { fwrite(STDERR, "cannot read $src\n"); exit(1); }

$sections = array();
$cur = null;
$relocated = array();
$seen = array();
foreach (preg_split('/\R/', $md) as $line) {
	if (preg_match('/^## (.+)$/', $line, $m)) {
		$cur = trim($m[1]);
		$sections[$cur] = array();
		continue;
	}
	if ($cur === null) { continue; }
	if (!preg_match('/^- (.*?)\s*<!--\s*(.+?)\s*-->\s*$/', $line, $m)) { continue; }
	$text = $m[1];
	$ids  = $m[2];
	$seen[$ids] = true;
	if (isset($OVERRIDE[$ids])) { $text = $OVERRIDE[$ids]; }
	if (in_array($ids, $RELOCATE, true)) { $relocated[$ids] = $text; continue; }
	$sections[$cur][] = array($text, $ids);
}

foreach ($RELOCATE as $ids) {
	if (!isset($seen[$ids])) { fwrite(STDERR, "relocated feature $ids is no longer in the source\n"); exit(1); }
}
foreach (array_keys($OVERRIDE) as $ids) {
	if (!isset($seen[$ids])) { fwrite(STDERR, "overridden feature $ids is no longer in the source\n"); exit(1); }
}

/** Markdown inline -> HTML. Backticks are the only markup the source uses in a bullet. */
function inline($s) {
	$s = htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
	return preg_replace('/`([^`]+)`/', '<code>$1</code>', $s);
}
function slug($s) {
	return trim(preg_replace('/-+/', '-', preg_replace('/[^a-z0-9]+/', '-', strtolower($s))), '-');
}

$total = 0;
$nav = array();
$body = array();
foreach ($sections as $title => $items) {
	if (!$items) { continue; }
	$id = slug($title);
	$total += count($items);
	$nav[] = '<a href="#' . $id . '">' . inline($title) . '</a>';
	$out = "<section class=\"act\" id=\"$id\">\n<h2>" . inline($title)
		. ' <span class="ct">' . count($items) . "</span></h2>\n<ul class=\"feats\">\n";
	foreach ($items as $it) {
		$out .= "\t<li>" . inline($it[0]) . " <!-- " . $it[1] . " --></li>\n";
	}
	$body[] = $out . "</ul>\n</section>";
}

$html = "<p class=\"count\">" . $total . " things it does. <a href=\"#edges\">And what it does not.</a></p>\n\n"
	. "<nav class=\"jump\" aria-label=\"Sections\">\n\t" . implode("\n\t", $nav) . "\n</nav>\n\n"
	. implode("\n\n", $body) . "\n";

$phone = "<p>" . inline(reset($relocated)) . "</p>\n";

$doc = @file_get_contents($page);
if ($doc === false) { fwrite(STDERR, "cannot read $page\n"); exit(1); }
$doc = splice($doc, 'FEATURES', $html, $page);
$doc = splice($doc, 'PHONE', $phone, $page);
file_put_contents($page, $doc);
echo "features.html: $total features in " . count($body) . " sections, from $src\n";

function splice($doc, $name, $new, $page) {
	$a = "<!-- BEGIN GENERATED $name -->";
	$b = "<!-- END GENERATED $name -->";
	$i = strpos($doc, $a);
	$j = strpos($doc, $b);
	if ($i === false || $j === false || $j < $i) { fwrite(STDERR, "$page has no $name sentinels\n"); exit(1); }
	return substr($doc, 0, $i + strlen($a)) . "\n" . $new . substr($doc, $j);
}
