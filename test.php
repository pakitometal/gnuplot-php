<?php

	include_once('gnuplot.php');

	$gnuplot = new \pakitometal\gnuplotPHP;

	$fibo = [
		 [ 0, 0 ]
		,[ 1, 1 ]
		,[ 2, 1 ]
		,[ 3, 2 ]
		,[ 4, 3 ]
		,[ 5, 5 ]
		,[ 6, 8 ]
		,[ 7, 13 ]
		,[ 8, 21 ]
		,[ 9, 34 ]
		,[ 10, 55 ]
	];

	$gnuplot->key_position = \pakitometal\gnuplotPHP::KEY_POSITION_UNSET;
	$gnuplot->title = 'Fibonacci first 10 terms';
	$gnuplot->plotstyle = \pakitometal\gnuplotPHP::PLOTSTYLE_LINES;
	$gnuplot->terminal = \pakitometal\gnuplotPHP::TERMINAL_PNGCAIRO;
	file_put_contents(sys_get_temp_dir().'/fibo.png', $gnuplot->plot_data($fibo, [ 'set grid' ]));
	exit;
