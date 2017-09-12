# gnuplotPHP
A data plotting library for PHP using gnuplot.

Based in Gergwar GnuPlot (https://github.com/Gregwar/GnuPlot).

# Requirements
* PHP 5.4 (or greater).
* `gnuplot` 5.0 (or greater).

# Usage
gnuplotPHP works in a "batch like" mode. First, you should set the object properties to fit your needs. There are defined many constants for the properties, but they follow the gnuplot standard syntax, so setting them "manually" should work without problems. For example:

```php
$gnuplot->key_position = \pakitometal\gnuplotPHP::KEY_POSITION_UNSET;
$gnuplot->title = 'Data plot test';
$gnuplot->plotstyle = \pakitometal\gnuplotPHP::PLOTSTYLE_LINES;
$gnuplot->terminal = \pakitometal\gnuplotPHP::TERMINAL_PNGCAIRO;
```

When ready to plot, call the `plot_data` method, passing an array with the data to plot as a parameter. This method will return an string with the plotted data, which can be written to a file:

```php
$graph = $gnuplot->plot_data($dataset);
file_put_contents('test.png', $graph);
```

You can find a full (basic) example of use in the [test.php](test.php) file.

Most property values and extra commands use the standard gnuplot syntax. Refer to the [gnuplot homepage](http://gnuplot.sourceforge.net/) for further details.

# License
See the [LICENSE](LICENSE) file for license rights and limitations (MIT).
