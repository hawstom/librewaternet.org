<?php
/**
 * build-chrome.php -- one navigation bar, on every page, from one definition.
 *
 * Tom, 2026-09-12: *"The LWN navigation is not consistent. I like the navigation among Credits
 * and its siblings. But it gets crazy at index.html. If you need to use some simple php, why not
 * do that?"*
 *
 * WHAT WAS WRONG, measured across the seven pages before this ran:
 *   * Four pages carried the same five-link bar. Two carried `header.tb`, a different chrome
 *     with no site navigation at all -- screenshots.html had no <nav> element of any kind.
 *   * index.html carried eleven links in its bar, six of which were jumps to sections of
 *     itself. A site bar and a table of contents in one strip is why it read as crazy.
 *   * screenshots.html and epanet.html were in NOBODY's navigation. You could arrive at them
 *     and you could not get to them.
 *
 * A BUILD STEP RATHER THAN RUNTIME PHP, though Tom offered it. The pages are served as .html and
 * `/app/` is already a rewrite on that host; renaming seven files to .php changes seven public
 * URLs and every link into them to save nothing a build does not. This is also the pattern the
 * repository already uses for the feature list, so there is one habit rather than two.
 *
 *     php tools/build-chrome.php
 *
 * It rewrites only what sits between the sentinels. Everything else on a page is hand-written.
 */

/**
 * The site bar. **SIX ENTRIES, AND epanet.html IS DELIBERATELY NOT ONE.**
 * About EPANET is a supporting page for Credits, reached from it and about somebody else's
 * software; a seventh entry would give the bar two ranks of importance and no way to show it.
 * Being on it marks Credits current instead, which is where a reader came from and where Back
 * would take them.
 */
$NAV = array(
	'index.html'       => 'Front page',
	'features.html'    => 'Feature list',
	'screenshots.html' => 'Screenshots',
	'credits.html'     => 'Credits',
	'disclosures.html' => 'Disclosures',
	'citations.html'   => 'Citations',
);
/** A page that is not in the bar, and the entry that should read as current while you are on it. */
$CHILD_OF = array('epanet.html' => 'credits.html');

$pages = array_merge(array_keys($NAV), array_keys($CHILD_OF));
$root  = dirname(__DIR__);
$n     = 0;

foreach ($pages as $page) {
	$path = $root . '/' . $page;
	$doc  = @file_get_contents($path);
	if ($doc === false) { fwrite(STDERR, "cannot read $page\n"); exit(1); }

	$current = isset($CHILD_OF[$page]) ? $CHILD_OF[$page] : $page;
	$html  = "<div class=\"marks\">\n\t\t<div class=\"wordmark\"><span class=\"libre\">Libre</span>WaterNet</div>\n\t</div>\n";
	$html .= "\t<nav>\n";
	foreach ($NAV as $href => $label) {
		// aria-current is the whole of "you are here": it is what a screen reader announces and
		// what the stylesheet colours. A second marker class would be the same fact twice.
		$mark = ($href === $current) ? ' aria-current="page"' : '';
		$html .= "\t\t<a href=\"$href\"$mark>$label</a>\n";
	}
	$html .= "\t</nav>\n";

	$a = '<!-- BEGIN GENERATED CHROME -->';
	$b = '<!-- END GENERATED CHROME -->';
	$i = strpos($doc, $a);
	$j = strpos($doc, $b);
	if ($i === false || $j === false || $j < $i) {
		fwrite(STDERR, "$page has no CHROME sentinels; add them inside <header class=\"topbar\">\n");
		exit(1);
	}
	$doc = substr($doc, 0, $i + strlen($a)) . "\n\t" . $html . "\t" . substr($doc, $j);
	file_put_contents($path, $doc);
	$n++;
}
echo "chrome: $n page(s), " . count($NAV) . " nav entries\n";
