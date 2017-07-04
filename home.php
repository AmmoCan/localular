<?php
  // Variables.
  $dir = 'localular/';
  $server_name = $_SERVER['SERVER_NAME'];
  $server_uri = $_SERVER['REQUEST_URI'];
  $server = $server_name . $server_uri;
  $php_version = PHP_VERSION;
  $mysqli_version = explode( ' ', mysqli_get_client_info() );
  $apache_string = ( function_exists( 'apache_get_version' ) ) ? apache_get_version() : 'Version not available';
  $apache_version = substr($apache_string, 0, strrpos(substr( $apache_string, 0, 21), ' '));

  // Select files and remove restricted files/folders.
  $files = array_diff( glob( '*' ), array( '.', '..', 'index.php', 'localular', 'README.md', 'robots.txt', 'bower_components', 'license.txt', 'node_modules', 'dist' ) );

// Create associative array with file name, file type, dateformat, icon, and server info.
$i = 0;
foreach ( $files as $key => $file ) {
	$list[] = array(
    'file' => utf8_encode( $file ),
    'type' => substr( strrchr( $file, '.' ), 1 ),
    'date' => @date( 'Y-m-d', filemtime( $file ) ),
    'date_format' => @date( 'Y-m-d G:i:s', filemtime( $file ) ),
    'icon' => '',
    'server' => $server,
    );
    switch ( $list[ $i ]['type'] ) {
        case 'css':
            $list[ $i ]['icon'] = 'fa fa-css3';
          break;
        case 'sass':
        case 'scss':
            $list[ $i ]['icon'] = 'sass-icon';
          break;
        case 'html':
            $list[ $i ]['icon'] = 'fa fa-html5';
          break;
        case 'js':
            $list[ $i ]['icon'] = 'js-icon';
          break;
        case 'json':
            $list[ $i ]['icon'] = 'jsonld-icon';
          break;
        case 'pdf':
            $list[ $i ]['icon'] = 'fa fa-file-pdf-o';
          break;
        case 'php':
            $list[ $i ]['icon'] = 'php-icon';
          break;
        case 'txt':
            $list[ $i ]['icon'] = 'fa fa-file-text-o';
          break;
        case 'zip':
            $list[ $i ]['icon'] = 'fa fa-file-archive-o';
          break;
        case 'sql':
            $list[ $i ]['icon'] = 'sql-icon';
          break;
        case 'xml':
            $list[ $i ]['icon'] = 'fa fa-file-code-o';
          break;
        case 'io':
            $list[ $i ]['icon'] = 'fa fa-github';
          break;
        case 'png':
        case 'jpg':
        case 'gif':
            $list[ $i ]['icon'] = 'fa fa-file-image-o';
          break;
        case 'otf':
        case 'woff':
        case 'woff2':
        case 'ttf':
        case 'eot':
            $list[ $i ]['icon'] = 'font-icon';
          break;
        case 'svg':
            $list[ $i ]['icon'] = 'svg-icon';
          break;
        case 'mov':
            $list[ $i ]['icon'] = 'video-icon';
          break;
        default:
            $list[ $i ]['icon'] = 'fa fa-folder-o';
    }// End switch().

    ++$i;
}// End foreach().

// Create JSON data.
$list = ( isset( $list ) ? json_encode( $list ) : json_encode( array() ) );
?>
<!DOCTYPE html>
<html lang="en" ng-app="localular">
<head>
  <!--
    Theme: Localular
    Developed by: Ammo
    Date: 04 JUL 2017
  -->
  <base href="/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Localular</title>
	<meta name="description" content="A modern theme for your Apache localhost directory.">
	<link rel="shortcut icon" href="<?php echo $server_uri . $dir ?>app/assets/img/favicon.ico">
	<link rel="stylesheet" href="<?php echo $server_uri . $dir ?>app/assets/css/styles.min.css">
	<link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
</head>
<body style="display: none;" ng-init="byDate=true">

  <main id="main" class="grid-frame site-main" role="main">
    <div id="content" class="vertical medium-horizontal grid-block">

      <aside id="secondary" class="small-12 medium-3 grid-container" role="complementary">
      	<header id="masthead" class="app-header grid-block small-up-1" role="banner">

        	<div id="logo-wrap" class="grid-content">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="logo rotate" aria-labelledby="title desc" role="img">
              <title id="title">Localular logo</title>
              <desc id="desc">A custom circular logo.</desc>
              <a xlink:href="#logo-wrap" tabindex="0" role="link">
              <path d="M256,0C114.6,0,0,114.6,0,256s114.6,256,256,256s256-114.6,256-256S397.4,0,256,0z M256,496.6
              	C123.1,496.6,15.4,388.9,15.4,256C15.4,123.1,123.1,15.4,256,15.4c132.9,0,240.6,107.7,240.6,240.6
              	C496.6,388.9,388.9,496.6,256,496.6z"/>
              <g id="circle">
              	<polygon points="301.8,416 256,356.5 209.4,416 	"/>
              	<path d="M256,256l166.5,160.1c40-41.5,64.5-98,64.5-160.1c0-127.6-103.4-231-231-231S25,128.4,25,256c0,62.1,24.5,118.5,64.4,160
              		L256,256z"/>
              	<path d="M250.5,486.9c-0.4,0-0.7,0-1.1,0C249.8,486.9,250.2,486.9,250.5,486.9z"/>
              	<path d="M267.3,486.7c0.3,0,0.6,0,0.8,0C267.9,486.7,267.6,486.7,267.3,486.7z"/>
              	<path d="M261.4,486.9c0.4,0,0.9,0,1.3,0C262.3,486.9,261.9,486.9,261.4,486.9z"/>
              </g>
              </a>
            </svg>
          </div>

          <div class="brand grid-content">
            <h1>Localular</h1>
            <span>Version 1</span>
          </div>

          <div class="info grid-content">
  					<ul>
  						<li><i class="php-icon" aria-hidden="true"></i><span>PHP:&nbsp;v<?php echo $php_version ?></span></li>
  						<li><i class="msql-icon" aria-hidden="true"></i><span>MySQL:&nbsp;v<?php echo $mysqli_version[1] ?></span></li>
  						<li><i class="apache-icon" aria-hidden="true"></i><span>Apache:&nbsp;<?php echo $apache_version ?></span></li>
  						<li><a class="pma" href="/phpmyadmin" target="_blank" title="Go to phpMyAdmin"><i class="sql-icon" aria-hidden="true"></i></a><span>Go to phpMyAdmin</span></li>
  					</ul>
  				</div>

      	</header>

      	<footer id="colophon" class="app-footer grid-block small-up-1" role="contentinfo">
        	<div class="copyright grid-content">

          	<address>
              &copy; <?php echo date( 'Y' ); ?>&nbsp;<a href="https://github.com/AmmoCan" target="_blank" title="Go visit Ammo on Github">AmmoCan</a>
        			<span class="sep">&nbsp;|&nbsp;</span>
        			<a href="https://github.com/AmmoCan/localular" target="_blank" title="Go visit project on Github">GitHub</a> Project.
      			</address>

      		</div>
      	</footer>
      </aside>

      <project id="primary" class="small-12 medium-9 grid-container"></project>

    </div>
  </main>

	<script type="text/javascript">
		var list = <?php echo $list; ?>;
	</script>
	<script src="<?php echo $server_uri . $dir ?>app/assets/js/scripts.min.js"></script>
	<script src="<?php echo $server_uri . $dir ?>app/assets/js/index.js"></script>
	<script src="<?php echo $server_uri . $dir ?>app/project/project.component.js"></script>
</body>
</html>
