<?php
function version(){
	//Git Statements
	exec("git status -s | cut -c4- | grep -E '\.js$|\.css$' > gitdiff.txt");

	//Will just version latest commit head
	//exec("git diff-tree --no-commit-id --name-only -r head | grep -E '\.js|\.css' > gitdiff.txt");
	$commitId = exec("git log -n1 --format='%h'");

	//Path to where you want to update script calls
	$fileToUpdate = [
		'public/scripts/route.js',
		'app/views/index/index.volt'
	];

	$files = explode(PHP_EOL, (file_get_contents('gitdiff.txt')));

	$patterns = array();
	$replacements = array();

    //Preparing file list patterns and their replacements
	foreach($files as $file) {

		//Comment this if you dont want to strip any starting path
		$file = preg_replace('/^public\//', '',$file);

		$fileVersion = $file . '?ver=' . $commitId;

		if($file != '') {
			$patterns[] = "[$file([^'\"]*)]";
			$replacements[] = $fileVersion;             
		}
	}

	foreach($fileToUpdate as $appFile) {
		$current = file_get_contents($appFile);
		$code = preg_replace($patterns, $replacements, $current, -1, $count);        
		file_put_contents($appFile, $code);

		// Can be removed just for the sake of reporting files replaced in each file source
		echo "=============== $appFile ($count replaced) \n";
		foreach($patterns as $p){
			preg_match($p, $code, $matches);
			if(!empty($matches)){
				echo $matches[0]."\n";
			}
		}
		echo "\n";
	}
}

version();
