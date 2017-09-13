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

	$fibo = [ '2017-06-29' => [ '2017-06-29', 225, 225, 290, 290 ] ];

	$gnuplot->key_position = \pakitometal\gnuplotPHP::KEY_POSITION_UNSET;
	$gnuplot->title = 'Fibonacci first 10 terms';
	$gnuplot->y_range = '0:500';
	$gnuplot->x_range = '2017-06-25:2017-06-30';
	$gnuplot->x_format = '%Y-%m-%d';
	$gnuplot->x_ticks_time = true;
	$gnuplot->plotstyle = \pakitometal\gnuplotPHP::PLOTSTYLE_CANDLESTICKS;
	$gnuplot->terminal = \pakitometal\gnuplotPHP::TERMINAL_PNGCAIRO;
	file_put_contents(sys_get_temp_dir().'/fibo.png', $gnuplot->plot_data($fibo, [ 'set grid' ]));
	exit;
