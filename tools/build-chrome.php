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
 * The site bar. **epanet.html IS DELIBERATELY NOT ON IT.**
 * About EPANET is a supporting page for Credits, reached from it and about somebody else's
 * software; an entry of its own would give the bar two ranks of importance and no way to show it.
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
	// **CONTACT IS THE SUITE'S OWN PAGE, AND THAT IS EXPLICITLY FOR NOW** (Tom, 2026-09-12: *"LWN
	// lacks a Contact link. For now, add the standard Contact page."*). It is the only contact
	// form that exists, it is already translated into 27 languages, and it is served from this
	// host at /engcalcs/contact.php -- so the honest cheap answer is to point at it rather than
	// write a second form here that would post to the same script.
	//
	// **ROOT-RELATIVE, like every other link on this site** (Tom, 2026-09-12: *"What justification
	// is there for absolute links to same site? This is making testing confusing."* There was
	// none, and `docs/local-development.md` had been recording the cost as a curiosity: "Start a
	// model" on a LOCAL page left the local site and opened the live one, so the one link a local
	// preview most wants to test was the one link it could not.) A leading slash and not a bare
	// `engcalcs/contact.php`: the bar is generated into pages at the root today, but it is the
	// shared chrome and it must not resolve against whatever directory a page is served from --
	// the same rule the suite's own `nav_link_absolute_check.php` holds. It carries no `?from=` -- that
	// parameter names a CALCULATOR the invitation was clicked on, and formmail.php validates it
	// against the real page list, so anything invented here reaches the e-mail as "not recorded"
	// anyway. Arriving by the menu is what actually happened.
	'/engcalcs/contact.php' => 'Contact',
);
/** A page that is not in the bar, and the entry that should read as current while you are on it. */
$CHILD_OF = array('epanet.html' => 'credits.html');

// The bar may name a page this repository does not own -- Contact is served from the suite, under
// a mount this repository has no files for -- so the list of files to REWRITE is the half of the
// bar that IS a file here, never the bar itself. A full URL and a rooted path are both "not ours";
// what makes a page ours is a plain relative name.
$local = array_values(array_filter(array_keys($NAV), function ($h) {
	return strpos($h, '://') === false && substr($h, 0, 1) !== '/';
}));
$pages = array_merge($local, array_keys($CHILD_OF));
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
