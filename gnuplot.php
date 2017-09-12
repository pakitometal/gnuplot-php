<?php

/**
* MIT License
*
* Copyright (c) 2017 Francisco Licerán Peralbo
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
**/

	namespace pakitometal;
	class gnuplotPHP {

		/* INI - Class constants */
		const GNUPLOT_BINARY = '/usr/bin/gnuplot';

		const TERMINAL_DUMB     = 'dumb';
		const TERMINAL_GIF      = 'gif';
		const TERMINAL_JPEG     = 'jpeg';
		const TERMINAL_PDFCAIRO = 'pdfcairo';
		const TERMINAL_PNG      = 'png';
		const TERMINAL_PNGCAIRO = 'pngcairo';
		const TERMINAL_SVG      = 'svg';

		const PLOTSTYLE_BOXERRORBARS   = 'boxerrorbars';
		const PLOTSTYLE_BOXES          = 'boxes';
		const PLOTSTYLE_BOXXYERRORBARS = 'boxxyerrorbars';
		const PLOTSTYLE_CANDLESTICKS   = 'candlesticks';
		const PLOTSTYLE_CIRCLES        = 'circles';
		const PLOTSTYLE_ELLIPSES       = 'ellipses';
		const PLOTSTYLE_DOTS           = 'dots';
		const PLOTSTYLE_FILLEDCURVES   = 'filledcurves';
		const PLOTSTYLE_FILLSTEPS      = 'fillsteps';
		const PLOTSTYLE_FINANCEBARS    = 'financebars';
		const PLOTSTYLE_FSTEPS         = 'fsteps';
		const PLOTSTYLE_HISTEPS        = 'histeps';
		const PLOTSTYLE_HISTOGRAM      = 'histogram';
		const PLOTSTYLE_IMAGE          = 'image';
		const PLOTSTYLE_IMPULSES       = 'impulses';
		const PLOTSTYLE_LABELS         = 'labels';
		const PLOTSTYLE_LINES          = 'lines';
		const PLOTSTYLE_LINESPOINTS    = 'linespoints';
		const PLOTSTYLE_PARALLELAXES   = 'parallelaxes';
		const PLOTSTYLE_POINTS         = 'points';
		const PLOTSTYLE_STEPS          = 'steps';
		const PLOTSTYLE_RGBALPHA       = 'rgbalpha';
		const PLOTSTYLE_RGBIMAGE       = 'rgbimage';
		const PLOTSTYLE_VECTORS        = 'vectors';
		const PLOTSTYLE_XERRORBARS     = 'xerrorbars';
		const PLOTSTYLE_XYERRORBARS    = 'xyerrorbars';
		const PLOTSTYLE_YERRORBARS     = 'yerrorbars';
		const PLOTSTYLE_XERRORLINES    = 'xerrorlines';
		const PLOTSTYLE_XYERRORLINES   = 'xyerrorlines';
		const PLOTSTYLE_YERRORLINES    = 'yerrorlines';

		const UNIT_CM   = 'cm';
		const UNIT_INCH = 'in';
		const UNIT_NONE = '';

		const KEY_ALIGN_CENTER     = 'center';
		const KEY_ALIGN_LEFT       = 'left';
		const KEY_ALIGN_RIGHT      = 'right';
		const KEY_POSITION_INSIDE  = 'inside';
		const KEY_POSITION_OUTSIDE = 'outside';
		const KEY_POSITION_UNSET   = 'unset';
		const KEY_STYLE_BOX        = 'box';
		const KEY_STYLE_NOBOX      = 'nobox';
		const KEY_VALIGN_BOTTOM    = 'bottom';
		const KEY_VALIGN_CENTER    = 'center';
		const KEY_VALIGN_TOP       = 'top';

		const BOX_FILL_STYLE_EMPTY   = 'empty';
		const BOX_FILL_STYLE_PATTERN = 'pattern';
		const BOX_FILL_STYLE_SOLID   = 'solid';
		/* END - Class constants */

		/* INI - Object properties */
		private $background_color;
		private $box_fill_opacity;
		private $box_fill_style;
		private $box_relative_width;
		private $canvas_height;
		private $canvas_width;
		private $font_face;
		private $font_size;
		private $graph_scale_x;
		private $graph_scale_y;
		private $key_align;
		private $key_font_face;
		private $key_font_size;
		private $key_position;
		private $key_style;
		private $key_valign;
		private $linetype_color;
		private $linetype_dash;
		private $linetype_point;
		private $linetype_width;
		private $plotstyle;
		private $terminal;
		private $title;
		private $title_font_face;
		private $title_font_size;
		private $unit;
		private $x_format;
		private $x_label;
		private $x_range;
		private $x_ticks_font_size;
		private $x_ticks_rotation;
		private $x_ticks_time;
		private $y_format;
		private $y_label;
		private $y_range;
		private $y_ticks_font_size;
		private $y_ticks_rotation;
		private $y_ticks_time;

		private $___gnuplot_binary;
		private $___command_queue;
		private $___data_tmpfile;
		/* END - Object properties */

		/* INI - Magic methods */
		public function __construct( $gnuplot_binary = false ) {
			if ( !$gnuplot_binary ) { $this->___gnuplot_binary = self::GNUPLOT_BINARY; }
			$this->reset();
		}

		public function __destruct() {
			@unlink($this->___data_tmpfile);
		}

		public function __get( $name ) {
			switch ( $name ) {
				case 'background_color':
				case 'box_fill_opacity':
				case 'box_fill_style':
				case 'box_relative_width':
				case 'canvas_height':
				case 'canvas_width':
				case 'font_face':
				case 'font_size':
				case 'graph_scale_x':
				case 'graph_scale_y':
				case 'key_align':
				case 'key_position':
				case 'key_style':
				case 'key_valign':
				case 'linetype_color':
				case 'linetype_dash':
				case 'linetype_point':
				case 'linetype_width':
				case 'plotstyle':
				case 'terminal':
				case 'title':
				case 'title_font_face':
				case 'title_font_size':
				case 'unit':
				case 'x_format':
				case 'x_label':
				case 'x_range':
				case 'x_ticks_font_size':
				case 'x_ticks_rotation':
				case 'x_ticks_time':
				case 'y_format':
				case 'y_label':
				case 'y_range':
				case 'y_ticks_font_size':
				case 'y_ticks_rotation':
				case 'y_ticks_time':
					return $this->$name;
					break;
			}
		}

		public function __set( $name, $value ) {
			switch ( $name ) {
				case 'box_fill_opacity':
				case 'box_relative_width':
					if ( 0 > $value || 1 < $value ) { $value = 1; }
					$this->$name = $value;
					break;
				case 'box_fill_style':
					switch ( $value ) {
						case self::BOX_FILL_STYLE_EMPTY:
						case self::BOX_FILL_STYLE_PATTERN:
						case self::BOX_FILL_STYLE_SOLID:
							break;
						default:
							$value = self::BOX_FILL_STYLE_EMPTY;
							break;
					}
					$this->box_fill_style = $value;
					break;
				case 'key_align':
					switch ( $value ) {
						case self::KEY_ALIGN_CENTER:
						case self::KEY_ALIGN_LEFT:
						case self::KEY_ALIGN_RIGHT:
							break;
						default:
							$value = self::KEY_ALIGN_RIGHT;
							break;
					}
					$this->key_align = $value;
					break;
				case 'key_position':
					switch ( $value ) {
						case self::KEY_POSITION_INSIDE:
						case self::KEY_POSITION_OUTSIDE:
						case self::KEY_POSITION_UNSET:
							break;
						default:
							$value = self::KEY_POSITION_INSIDE;
							break;
					}
					$this->key_position = $value;
					break;
				case 'key_style':
					switch ( $value ) {
						case self::KEY_STYLE_BOX:
						case self::KEY_STYLE_NOBOX:
							break;
						default:
							$value = self::KEY_STYLE_NOBOX;
							break;
					}
					$this->key_style = $value;
					break;
				case 'key_valign':
					switch ( $value ) {
						case self::KEY_VALIGN_BOTTOM:
						case self::KEY_VALIGN_CENTER:
						case self::KEY_VALIGN_TOP:
							break;
						default:
							$value = self::KEY_VALIGN_TOP;
							break;
					}
					$this->key_valign = $value;
					break;
				case 'plotstyle':
					switch ( $value ) {
						case self::PLOTSTYLE_BOXERRORBARS:
						case self::PLOTSTYLE_BOXES:
						case self::PLOTSTYLE_BOXXYERRORBARS:
						case self::PLOTSTYLE_CANDLESTICKS:
						case self::PLOTSTYLE_CIRCLES:
						case self::PLOTSTYLE_ELLIPSES:
						case self::PLOTSTYLE_DOTS:
						case self::PLOTSTYLE_FILLEDCURVES:
						case self::PLOTSTYLE_FILLSTEPS:
						case self::PLOTSTYLE_FINANCEBARS:
						case self::PLOTSTYLE_FSTEPS:
						case self::PLOTSTYLE_HISTEPS:
						case self::PLOTSTYLE_HISTOGRAM:
						case self::PLOTSTYLE_IMAGE:
						case self::PLOTSTYLE_IMPULSES:
						case self::PLOTSTYLE_LABELS:
						case self::PLOTSTYLE_LINES:
						case self::PLOTSTYLE_LINESPOINTS:
						case self::PLOTSTYLE_PARALLELAXES:
						case self::PLOTSTYLE_POINTS:
						case self::PLOTSTYLE_STEPS:
						case self::PLOTSTYLE_RGBALPHA:
						case self::PLOTSTYLE_RGBIMAGE:
						case self::PLOTSTYLE_VECTORS:
						case self::PLOTSTYLE_XERRORBARS:
						case self::PLOTSTYLE_XYERRORBARS:
						case self::PLOTSTYLE_YERRORBARS:
						case self::PLOTSTYLE_XERRORLINES:
						case self::PLOTSTYLE_XYERRORLINES:
						case self::PLOTSTYLE_YERRORLINES:
							break;
						default:
							$value = self::PLOTSTYLE_LINES;
							break;
					}
					$this->plotstyle = $value;
					break;
				case 'terminal':
					switch ( $value ) {
						case self::TERMINAL_DUMB:
						case self::TERMINAL_GIF:
						case self::TERMINAL_JPEG:
						case self::TERMINAL_PDFCAIRO:
						case self::TERMINAL_PNG:
						case self::TERMINAL_PNGCAIRO:
						case self::TERMINAL_SVG:
							break;
						default:
							$value = self::TERMINAL_PNGCAIRO;
							break;
					}
					$this->terminal = $value;
					break;
				case 'unit':
					switch ( $value ) {
						case self::UNIT_CM:
						case self::UNIT_INCH:
						case self::UNIT_NONE:
							break;
						default:
							$value = self::UNIT_NONE;
							break;
					}
					$this->unit = $value;
					break;
				case 'x_range':
				case 'y_range':
					if ( count(explode(':', $value)) != 2 ) { $value = false; }
					$this->$name = $value;
					break;
				case 'x_ticks_rotation':
				case 'y_ticks_rotation':
					$this->$name = $value % 360;
					break;
				case 'x_ticks_time':
				case 'y_ticks_time':
					$this->$name = (bool)$value;
					break;
				case 'graph_scale_x':
				case 'graph_scale_y':
					if ( strpos($value, '%') ) { $value = (int)$value / 100.0; }
				case 'canvas_height':
				case 'canvas_width':
				case 'font_size':
				case 'linetype_width':
				case 'title_font_size':
				case 'x_ticks_font_size':
				case 'y_ticks_font_size':
					$value = abs($value);
				case 'background_color':
				case 'font_face':
				case 'key_font_face':
				case 'linetype_color':
				case 'linetype_dash':
				case 'linetype_point':
				case 'title':
				case 'title_font_face':
				case 'x_label':
				case 'x_format':
				case 'y_label':
				case 'y_format':
					$this->$name = $value;
					break;
			}
		}
		/* END - Magic methods */

		/* INI - Private methods */

		/**
		* Enqueues gnuplot commands.
		*
		* @param $command Mixed String or Array of Strings with the command(s) to be enqueued.
		*
		* @modify $this->___command_queue, adding the passed command(s) to the end.
		*
		*/
		private function ___enqueue_command( $command ) {
			if ( is_string($command) ) { $command = [ $command ]; }
			$this->___command_queue = array_merge($this->___command_queue, $command);
		}

		/**
		* Executes the command queue in gnuplot.
		*
		* @param $flush Boolean true to flush the command queue after the execution, false otherwise. Default: true.
		*
		* @modify If $flush is true, $this->___command_is emptied (set to empty array).
		*
		*/
		private function ___execute_queue( $flush = true ) {
			$command_queue = implode(' ; ', $this->___command_queue);
			if ( $flush ) { $this->___command_queue = []; }
			return shell_exec($this->___gnuplot_binary.' -e \''.str_replace("'", "\'", $command_queue).'\'');
		}

		/**
		* Initializes a temp file with the data to plot.
		*
		* Throws an Exception if the data is not valid for the current plot style (set in $this->plotstyle),
		* or if the temp file couldn't be created.
		*
		* @param $data Array with the data to be plotted.
		*
		* @modify $this->___data_tmpfile is set to the full path of the created temp file.
		*
		*/
		private function ___init_data_tmpfile ( $data = [] ) {
			if ( !$this->___validate_data($data) ) { throw new \Exception('Invalid data for plotstyle "'.$this->plotstyle.'"'); return;  }
			if ( !($this->___data_tmpfile = tempnam(sys_get_temp_dir(), 'DAT')) ) { throw new \Exception('Failed creating temp data file'); return; }
			if ( $fp = fopen($this->___data_tmpfile, 'w') ) {
				foreach ( $data as $row ) { fwrite($fp, implode("\t", $row).PHP_EOL); }
				fclose($fp);
			}
		}

		/**
		* Initializes the command queue for a new plot, applying the properties of the current object.
		*
		*/
		private function ___init_data_plot() {
			switch ( $this->terminal ) {
				case self::TERMINAL_DUMB:
					$terminal = 'set terminal '.$this->terminal.' size '.$this->canvas_width.','.$this->canvas_height;
					break;
				case self::TERMINAL_PDFCAIRO:
				case self::TERMINAL_PNGCAIRO:
					$terminal = 'set terminal '.$this->terminal.' size '.$this->canvas_width.$this->unit.','.$this->canvas_height.$this->unit.' background rgb "'.$this->background_color.'" font "'.$this->font_face.','.$this->font_size.'"';
					break;
				default:
					$terminal = 'set terminal '.$this->terminal.' size '.$this->canvas_width.','.$this->canvas_height.' background rgb "'.$this->background_color.'" font "'.$this->font_face.','.$this->font_size.'"';
					break;
			}
			$command_queue = [
				 $terminal
				,'set size '.$this->graph_scale_x.','.$this->graph_scale_y
				,'set style data '.$this->plotstyle
			];

			$linetype = [];
			if ( $this->linetype_color ) { $linetype[] = 'lc "'.$this->linetype_color.'"'; }
			if ( $this->linetype_dash ) { $linetype[] = 'dt '.$this->linetype_dash; }
			if ( $this->linetype_point ) { $linetype[] = 'pt '.$this->linetype_point; }
			if ( $this->linetype_width ) { $linetype[] = 'lw '.$this->linetype_width; }
			if ( $linetype ) { $command_queue[] = 'set linetype 1 '.implode(' ', $linetype); }

			switch ( $this->plotstyle ) {
				case self::PLOTSTYLE_BOXERRORBARS:
				case self::PLOTSTYLE_BOXES:
				case self::PLOTSTYLE_BOXXYERRORBARS:
				case self::PLOTSTYLE_CANDLESTICKS:
				case self::PLOTSTYLE_HISTOGRAM:
					$command_queue[] = 'set boxwidth '.$this->box_relative_width.' relative';
					$fill_style = 'set style fill '.$this->box_fill_style;
					if ( self::BOX_FILL_STYLE_SOLID == $this->box_fill_style ) { $fill_style .= ' '.$this->box_fill_opacity; }
					$command_queue[] = $fill_style;
					break;
			}

			if ( self::KEY_POSITION_UNSET == $this->key_position ) { $command_queue[] = 'unset key'; }
			else {
				$command_queue[] = 'set key '.$this->key_position.' '.$this->key_align.' '.$this->key_valign.' '.$this->key_style;
				$command_queue[] = 'set key font "'.$this->key_font_face.','.$this->key_font_size.'"';
			}
			if ( $this->title ) { $command_queue[] = 'set title "'.$this->title.'" font "'.$this->title_font_face.','.$this->title_font_size.'"'; }
			if ( $this->x_label ) { $command_queue[] = 'set xlabel "'.$this->x_label.'"'; }
			if ( $this->y_label ) { $command_queue[] = 'set ylabel "'.$this->y_label.'"'; }
			$xticks = 'set xtics rotate by '.$this->x_ticks_rotation.'right font ",'.$this->x_ticks_font_size.'"';
			if ( $this->x_ticks_time ) { $xticks.= ' time'; $command_queue[] = 'set format x '.$this->x_format; }
			$command_queue[] = $xticks;
			$yticks = 'set ytics rotate by '.$this->y_ticks_rotation.'right font ",'.$this->y_ticks_font_size.'"';
			if ( $this->y_ticks_time ) { $yticks.= ' time'; $command_queue[] = 'set format y '.$this->y_format; }
			$command_queue[] = $yticks;
			if ( $this->x_range ) { $command_queue[] = 'set xrange ['.$this->x_range.']'; }
			if ( $this->y_range ) { $command_queue[] = 'set yrange ['.$this->y_range.']'; }
			$this->___enqueue_command($command_queue);
		}

		/**
		* Validates the data for the plot style set in $this->plotstyle.
		*
		* @param $data Array with the data to be validated.
		*
		* @return Boolean true if the data is valid for the style set in $this->plotstyle, false otherwise.
		*
		*/
		private function ___validate_data( $data ) {

			/* Validates a dataset by its number of columns
			*
			* @param $dataset array of arrays, each one containig a row of data.
			* @param $min_cols Mixed integer min number of columns count in the $dataset
			* 	to be valid, or Boolean false if there is no column limitations. Default: false.
			* @param $max_cols Mixed integer max number of columns count in the $dataset
			* 	to be valid, or Boolean false if this number should be equal to $min_cols. Default: false.
			*
			* @return Boolean true if the dataset is valid for the given number of columns, false otherwise.
			*
			*/
			$validate = function ( $dataset, $min_cols = false, $max_cols = false ) {
				$max_cols = $max_cols ?? $min_cols;
				$cols_count = array_map(function( $row ) { return count($row); }, $dataset);
				if ( 1 < count(array_unique($cols_count)) ) { return false; }
				return ( (!$min_cols && !$max_cols) || ($min_cols <= $cols_count[0] && $cols_count[0] <= $max_cols) );
			};

			switch ( $this->plotstyle ) {
				case self::PLOTSTYLE_BOXERRORBARS:
					return $validate($data, 3, 5);
				case self::PLOTSTYLE_BOXES:
				case self::PLOTSTYLE_FILLEDCURVES:
					return $validate($data, 2, 3);
				case self::PLOTSTYLE_BOXXYERRORBARS:
				case self::PLOTSTYLE_XYERRORBARS:
				case self::PLOTSTYLE_XYERRORLINES:
					return $validate($data, 4) && $validate($data, 6);
				case self::PLOTSTYLE_CANDLESTICKS:
				case self::PLOTSTYLE_FINANCEBARS:
				case self::PLOTSTYLE_RGBIMAGE:
					return $validate($data, 5);
				case self::PLOTSTYLE_CIRCLES:
				case self::PLOTSTYLE_ELLIPSES:
					return $validate($data, 2, 5);
				case self::PLOTSTYLE_DOTS:
					return $validate($data, 2);
				case self::PLOTSTYLE_FILLSTEPS:
				case self::PLOTSTYLE_FSTEPS:
				case self::PLOTSTYLE_HISTEPS:
				case self::PLOTSTYLE_IMPULSES:
				case self::PLOTSTYLE_LINES:
				case self::PLOTSTYLE_LINESPOINTS:
				case self::PLOTSTYLE_POINTS:
				case self::PLOTSTYLE_STEPS:
					return $validate($data, 1, 2);
				case self::PLOTSTYLE_HISTOGRAM:
					return $validate($data, 1);
				case self::PLOTSTYLE_IMAGE:
				case self::PLOTSTYLE_LABELS:
					return $validate($data, 3);
				case self::PLOTSTYLE_PARALLELAXES:
					return $validate($data);
				case self::PLOTSTYLE_RGBALPHA:
					return $validate($data, 6);
				case self::PLOTSTYLE_VECTORS:
					return $validate($data, 4);
				case self::PLOTSTYLE_XERRORBARS:
				case self::PLOTSTYLE_XERRORLINES:
				case self::PLOTSTYLE_YERRORLINES:
					return $validate($data, 3, 4);
				case self::PLOTSTYLE_YERRORBARS:
					return $validate($data, 2, 4);
			}
			return false;
		}
		/* END - Private methods */

		/* INI - Public methods */

		/**
		* Resets the object for a new plot.
		*
		* @modify All object public properties, setting the to their default values. Also, empties the command queue.
		*
		*/
		public function reset() {
			$this->background_color    = '#ffffff';
			$this->box_fill_opacity    = 1;
			$this->box_fill_style      = self::BOX_FILL_STYLE_EMPTY;
			$this->box_relative_width  = 1;
			$this->canvas_height       = 480;
			$this->canvas_width        = 640;
			$this->font_face           = 'sans';
			$this->font_size           = 10;
			$this->graph_scale_x       = 1;
			$this->graph_scale_y       = 1;
			$this->key_align           = self::KEY_ALIGN_RIGHT;
			$this->key_font_face       = 'sans';
			$this->key_font_size       = $this->font_size;
			$this->key_position        = self::KEY_POSITION_INSIDE;
			$this->key_style           = self::KEY_STYLE_BOX;
			$this->key_valign          = self::KEY_VALIGN_TOP;
			$this->linetype_color      = false;
			$this->linetype_dash       = false;
			$this->linetype_point      = false;
			$this->linetype_width      = false;
			$this->plotstyle           = self::PLOTSTYLE_LINES;
			$this->terminal            = self::TERMINAL_PNGCAIRO;
			$this->title               = '';
			$this->title_font_face     = 'sans';
			$this->title_font_size     = 14;
			$this->unit                = self::UNIT_NONE;
			$this->x_format            = '';
			$this->x_label             = '';
			$this->x_range             = false;
			$this->x_ticks_font_size   = $this->font_size;
			$this->x_ticks_rotation    = 0;
			$this->x_ticks_time        = false;
			$this->y_format            = '';
			$this->y_label             = '';
			$this->y_range             = false;
			$this->y_ticks_font_size   = $this->font_size;
			$this->y_ticks_rotation    = 0;
			$this->y_ticks_time        = false;

			$this->___command_queue    = [];
		}

		/**
		* Plots a data set.
		*
		* @param $data Array with the data to be plotted.
		* @param $extra_commands Array with extra commands to be apllied to the plot.
		*
		* @return String with the output of the gnuplot plot command.
		*
		*/
		public function plot_data( $data, $extra_commands = [] ) {
			$this->___init_data_tmpfile($data);
			$this->___init_data_plot();
			$this->___enqueue_command(array_merge($extra_commands, [ 'plot "'.$this->___data_tmpfile.'"' ]));
			return $this->___execute_queue();
		}
		/* END - Public methods */

	}
