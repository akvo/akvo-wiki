<?php
/**
 * Akvo
 *
 * Heavily influenced from the Monobook theme.
 *
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */

if( !defined( 'MEDIAWIKI' ) )
	die( -1 );

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @ingroup Skins
 */
class SkinAkvo extends SkinTemplate {
	/** Using akvo. */
	function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$this->skinname  = 'akvo';
		$this->stylename = 'akvo';
		$this->template  = 'AkvoTemplate';

	}

	function setupSkinUserCss( OutputPage $out ) {
		global $wgHandheldStyle;

		parent::setupSkinUserCss( $out );

		// Append to the default screen common & print styles...
		$out->addStyle( 'akvo/style.css', 'screen' );
		if( $wgHandheldStyle ) {
			// Currently in testing... try 'chick/main.css'
			$out->addStyle( $wgHandheldStyle, 'handheld' );
		}

		$out->addStyle( 'akvo/IE50Fixes.css', 'screen', 'lt IE 5.5000' );
		$out->addStyle( 'akvo/IE55Fixes.css', 'screen', 'IE 5.5000' );
		$out->addStyle( 'akvo/IE60Fixes.css', 'screen', 'IE 6' );
		$out->addStyle( 'akvo/IE70Fixes.css', 'screen', 'IE 7' );

		$out->addStyle( 'akvo/rtl.css', 'screen', '', 'rtl' );
	}
}

/**
 * @todo document
 * @ingroup Skins
 */
class AkvoTemplate extends QuickTemplate {
	var $skin;
	/**
	 * Template filter callback for MonoBook (akvo) skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		global $wgRequest;
		$this->skin = $skin = $this->data['skin'];
		$action = $wgRequest->getText( 'action' );

		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

?><!DOCTYPE html>
<html lang="<?php $this->text('lang') ?>">
<head>
	<meta charset="UTF-8" />
	<meta name="description" content="We help donors and doers reach out to fund many thousands of new water and sanitation projects." />
	<meta name="keywords" content="akvo, Akvo, akvo.org, Akvo.org, water, sanitation" />
	<title>Akvopedia -  <?php $this->text('pagetitle') ?></title>
	<?php $this->html('csslinks') ?>

	<!--[if lt IE 7]><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/common/IEFixes.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"></script>
	<meta http-equiv="imagetoolbar" content="no" /><![endif]-->
		
	<?php print Skin::makeGlobalVariablesScript( $this->data ); ?>
		
	<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath' ) ?>/common/wikibits.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"><!-- wikibits js --></script>
	<!-- Head Scripts -->
<?php $this->html('headscripts') ?>
<?php	if($this->data['jsvarurl']) { ?>
	<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl') ?>"><!-- site js --></script>
<?php	} ?>
<?php	if($this->data['pagecss']) { ?>
	<style type="text/css"><?php $this->html('pagecss') ?></style>
<?php	}
	if($this->data['usercss']) { ?>
	<style type="text/css"><?php $this->html('usercss') ?></style>
<?php	}
	if($this->data['userjs']) { ?>
	<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs' ) ?>"></script>
<?php	}
	if($this->data['userjsprev']) { ?>
	<script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script>
<?php	}
	if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>
</head>
		
<body<?php if($this->data['body_ondblclick']) { ?> ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
<?php if($this->data['body_onload']) { ?> onload="<?php $this->text('body_onload') ?>"<?php } ?>
 class="mediawiki <?php $this->text('dir') ?> <?php $this->text('pageclass') ?> <?php $this->text('skinnameclass') ?>">	

<div id="header">
	<div id="header_container" class="container">
		<ul id="main_nav">
			<li>
				<a id="main_nav_left" href="/"><span>
					<img src="<?php $this->text('stylepath') ?>/akvo/img/main_nav_akvo_logo.png" width="82" height="20" alt="Akvo.org" />
				</span></a>
			</li>
			<li>
				<a href="/wiki/" class="active"><span>Akvopedia</span></a>
			</li>
			<li>
				<a href="/web/partners"><span>Partners</span></a>
			</li>
			<li>
				<a href="/rsr/projects/"><span>Projects</span></a>
			</li>
			<li>
				<a href="/web/get_involved/"><span>Get involved</span></a>
			</li>
			<li>
				<a href="/blog/"><span>Blog</span></a>
			</li>
		</ul>
	</div>
</div>
<a name="top" id="top"></a>
<div id="main_container" class="container">
	<div class="span-18" style="margin-bottom:20px;">
		<?php if($this->data['sitenotice']) { ?>
			<div id="siteNotice" class="white_box">
				<div class="space20" style="min-height:250px;">
					<?php $this->html('sitenotice') ?>
				</div>
			</div>
		<?php } ?>
		
		<div class="white_box">
			<div class="space20" style="min-height:250px;">
				<h5><?php $this->msg('views') ?></h5>
				<div style="float:left; widht:160px;">
					<?php
						$sidebar = $this->data['sidebar'];
						if ( !isset( $sidebar['SEARCH'] ) ) $sidebar['SEARCH'] = true;
						if ( !isset( $sidebar['TOOLBOX'] ) ) $sidebar['TOOLBOX'] = true;
						if ( !isset( $sidebar['LANGUAGES'] ) ) $sidebar['LANGUAGES'] = true;
						foreach ($sidebar as $boxName => $cont) {
							if ( $boxName == 'SEARCH' ) {
								$this->searchBox();
							} elseif ( $boxName == 'TOOLBOX' ) {
								$this->toolbox();
							} elseif ( $boxName == 'LANGUAGES' ) {
								$this->languageBox();
							} else {
								$this->customBox( $boxName, $cont );
							}
						}
					?>
					
					<h5><?php $this->msg('personaltools') ?></h5>
					<div class="pBody">
						<ul>
			<?php 			foreach($this->data['personal_urls'] as $key => $item) { ?>
							<li id="<?php echo Sanitizer::escapeId( "pt-$key" ) ?>"<?php
								if ($item['active']) { ?> class="active"<?php } ?>><a href="<?php
							echo htmlspecialchars($item['href']) ?>"<?php echo $skin->tooltipAndAccesskey('pt-'.$key) ?><?php
							if(!empty($item['class'])) { ?> class="<?php
							echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
							echo htmlspecialchars($item['text']) ?></a></li>
			<?php			} ?>
						</ul>
					</div>
					
					
				</div>
				<div style="float:right; width:735px; text-align:left; border-left:1px solid #ccc; padding-left:20px;">
					<h4>Page title:</h4>
					<h1 id="firstHeading">
						<?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?>
					</h1>

					<h4>Tagline:</h4>
					<h3 id="siteSub"><?php $this->msg('tagline') ?></h3>

					<h4>Subtitle:</h4>					
					<div id="contentSub"><?php $this->html('subtitle') ?></div>
					
					<?php if($this->data['undelete']) { ?>
						<div id="contentSub2">
							<?php $this->html('undelete') ?>
						</div>
					<?php } ?>

					<?php if($this->data['newtalk'] ) { ?>
						<div class="usermessage"><?php $this->html('newtalk')  ?></div>
					<?php } ?>
					
					<?php if($this->data['showjumplinks']) { ?>
						<div id="jump-to-nav"><?php $this->msg('jumpto') ?> 
							<a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a>
						</div>
					<?php } ?>
					
					<!-- start content -->
					<?php $this->html('bodytext') ?>
					<?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
					<!-- end content -->
					<?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>
				</div>
				<div class="clear"></div>
				<div style="background-color:#ccc;">
<?php 				if($this->data['poweredbyico']) { ?>
						<div id="f-poweredbyico"><?php $this->html('poweredbyico') ?></div>
<?php 				}
					if($this->data['copyrightico']) { ?>
						<div id="f-copyrightico"><?php $this->html('copyrightico') ?></div>
<?php				}
					// Generate additional footer links
					$footerlinks = array(
						'lastmod', 'viewcount', 'numberofwatchingusers', 'credits', 'copyright',
						'privacy', 'about', 'disclaimer', 'tagline',
					);
					$validFooterLinks = array();
					foreach( $footerlinks as $aLink ) {
						if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
							$validFooterLinks[] = $aLink;
						}
					}
					if ( count( $validFooterLinks ) > 0 ) {
?>						<ul id="f-list">
<?php 						foreach( $validFooterLinks as $aLink ) {
								if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
?>									<li id="<?php echo$aLink?>"><?php $this->html($aLink) ?></li>
<?php 							}
							}
?>						</ul>
<?php				}
?>				</div>
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<div id="footer_container" class="container">
		<div class="span-18">
			<h2>About Akvo.org</h2>
			<p>
				<span class="black" style="font-weight:bold;">We help donors and doers reach out to fund many thousands of new water and sanitation projects.</span> Money flows quickly because donors choose what to fund and follow progress online. People can use these storylines to build exciting new campaigns and networks. Our partners lead the world in sharing updates using Akvo tools. Better feedback means happy donors, and dialogue between field workers builds skills and improves quality. Time and money are saved while people across the world get safe drinking water and proper sanitation.
			</p>
		</div>
		<div class="span-18">
			<div class="span-3 first">
				<h3>Policies</h3>
				<p class="small">
					<a href="#">Privacy</a><br />
					<a href="#">Legal</a><br />
					<a href="#">Partners</a><br />
					<a href="#">Donations</a><br />
					<a href="#">Submissions</a>
				</p>
			</div>
			<div class="span-3">
				<h3>About</h3>
				<p class="small">
					<a href="#">Read our blog</a><br />
					<a href="#">Who are we?</a><br />
					<a href="#">How does it work</a><br />
					<a href="#">Financials</a><br />
					<a href="#">Statistics</a><br />
					<a href="#">FAQs</a><br />
					<a href="#">Thanks</a><br />
					<a href="#">Jobs</a><br />
				</p>
			</div>
			<div class="span-3">
				<h3>Partners</h3>
				<p class="small">
					<a href="#">Professionals</a><br />
					<a href="#">Organisations</a><br />
					<a href="#">Corporate</a><br />
					<a href="#">Volunteers</a><br />
					<a href="#">Knowledge</a><br />
				</p>
			</div>
			<div class="span-3">
				<h3>Developers</h3>
				<p class="small">
					<a href="#">Akvo Labs</a><br />
					<a href="#">Developer Guide</a><br />
					<a href="#">Source Code</a><br />
				</p>
			</div>
			<div class="span-3">
				<h3>Contact us</h3>
				<p class="small">
					<a href="http://help.akvo.org/">Help &amp; Support</a><br />
					<a href="#">Website Feedback</a><br />
					<a href="#">General Questions</a><br />
					<a href="#">Press Inquiries</a><br />
					<a href="#">Mailing Address</a><br />
					<a href="#">Directions</a><br />
				</p>
			</div>
			<div class="span-3">
				&nbsp;
			</div>
			<div class="span-3 last">
				
			</div>
		</div>
	</div>
</div>
<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
<?php $this->html('reporttime') ?>
<?php if ( $this->data['debug'] ): ?>
<!-- Debug output:
<?php $this->text( 'debug' ); ?>
-->
<?php endif; ?>
</body>
</html>
<?php
	wfRestoreWarnings();
	} // end of execute() method

	/*************************************************************************************************/
	function searchBox() {
		global $wgUseTwoButtonsSearchForm;
?>
	<div id="p-search" class="portlet">
		<h5><label for="searchInput"><?php $this->msg('search') ?></label></h5>
		<div id="searchBody" class="pBody">
			<form action="<?php $this->text('wgScript') ?>" id="searchform"><div>
				<input type='hidden' name="title" value="<?php $this->text('searchtitle') ?>"/>
				<input id="searchInput" name="search" type="text"<?php echo $this->skin->tooltipAndAccesskey('search');
					if( isset( $this->data['search'] ) ) {
						?> value="<?php $this->text('search') ?>"<?php } ?> />
				<input type='submit' name="go" class="searchButton" id="searchGoButton"	value="<?php $this->msg('searcharticle') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-go' ); ?> /><?php if ($wgUseTwoButtonsSearchForm) { ?>&nbsp;
				<input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg('searchbutton') ?>"<?php echo $this->skin->tooltipAndAccesskey( 'search-fulltext' ); ?> /><?php } else { ?>

				<div><a href="<?php $this->text('searchaction') ?>" rel="search"><?php $this->msg('powersearch-legend') ?></a></div><?php } ?>

			</div></form>
		</div>
	</div>
<?php
	}

	/*************************************************************************************************/
	function toolbox() {
?>
	<div class="portlet" id="p-tb">
		<h5><?php $this->msg('toolbox') ?></h5>
		<div class="pBody">
			<ul>
<?php
		if($this->data['notspecialpage']) { ?>
				<li id="t-whatlinkshere"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-whatlinkshere') ?>><?php $this->msg('whatlinkshere') ?></a></li>
<?php
			if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
				<li id="t-recentchangeslinked"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-recentchangeslinked') ?>><?php $this->msg('recentchangeslinked') ?></a></li>
<?php 		}
		}
		if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
			<li id="t-trackbacklink"><a href="<?php
				echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-trackbacklink') ?>><?php $this->msg('trackbacklink') ?></a></li>
<?php 	}
		if($this->data['feeds']) { ?>
			<li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
					?><a id="<?php echo Sanitizer::escapeId( "feed-$key" ) ?>" href="<?php
					echo htmlspecialchars($feed['href']) ?>" rel="alternate" type="application/<?php echo $key ?>+xml" class="feedlink"<?php echo $this->skin->tooltipAndAccesskey('feed-'.$key) ?>><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;
					<?php } ?></li><?php
		}

		foreach( array('contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) {

			if($this->data['nav_urls'][$special]) {
				?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-'.$special) ?>><?php $this->msg($special) ?></a></li>
<?php		}
		}

		if(!empty($this->data['nav_urls']['print']['href'])) { ?>
				<li id="t-print"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['print']['href'])
				?>" rel="alternate"<?php echo $this->skin->tooltipAndAccesskey('t-print') ?>><?php $this->msg('printableversion') ?></a></li><?php
		}

		if(!empty($this->data['nav_urls']['permalink']['href'])) { ?>
				<li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
				?>"<?php echo $this->skin->tooltipAndAccesskey('t-permalink') ?>><?php $this->msg('permalink') ?></a></li><?php
		} elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?>
				<li id="t-ispermalink"<?php echo $this->skin->tooltip('t-ispermalink') ?>><?php $this->msg('permalink') ?></li><?php
		}

		wfRunHooks( 'AkvoTemplateToolboxEnd', array( &$this ) );
		wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
?>
			</ul>
		</div>
	</div>
<?php
	}

	/*************************************************************************************************/
	function languageBox() {
		if( $this->data['language_urls'] ) {
?>
	<div id="p-lang" class="portlet">
		<h5><?php $this->msg('otherlanguages') ?></h5>
		<div class="pBody">
			<ul>
<?php		foreach($this->data['language_urls'] as $langlink) { ?>
				<li class="<?php echo htmlspecialchars($langlink['class'])?>"><?php
				?><a href="<?php echo htmlspecialchars($langlink['href']) ?>"><?php echo $langlink['text'] ?></a></li>
<?php		} ?>
			</ul>
		</div>
	</div>
<?php
		}
	}
	
	/*************************************************************************************************/
	function customBox( $bar, $cont ) {
?>
	<div class='generated-sidebar portlet' id='<?php echo Sanitizer::escapeId( "p-$bar" ) ?>'<?php echo $this->skin->tooltip('p-'.$bar) ?>>
		<h5><?php $out = wfMsg( $bar ); if (wfEmptyMsg($bar, $out)) echo $bar; else echo $out; ?></h5>
		<div class='pBody'>
<?php   if ( is_array( $cont ) ) { ?>
			<ul>
<?php 			foreach($cont as $key => $val) { ?>
				<li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
					if ( $val['active'] ) { ?> class="active" <?php }
				?>><a href="<?php echo htmlspecialchars($val['href']) ?>"<?php echo $this->skin->tooltipAndAccesskey($val['id']) ?>><?php echo htmlspecialchars($val['text']) ?></a></li>
<?php			} ?>
			</ul>
<?php   } else {
			# allow raw HTML block to be defined by extensions
			print $cont;
		}
?>
		</div>
	</div>
<?php
	}

} // end of class


