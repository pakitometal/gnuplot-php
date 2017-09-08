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

		const TERMINAL_CANVAS   = 'canvas';
		const TERMINAL_DUMB     = 'dumb';
		const TERMINAL_GIF      = 'gif';
		const TERMINAL_JPEG     = 'jpeg';
		const TERMINAL_PDFCAIRO = 'pdfcairo';
		const TERMINAL_PNG      = 'png';
		const TERMINAL_PNGCAIRO = 'pngcairo';
		const TERMINAL_SVG      = 'svg';

		const PLOTSTYLE_BOXERRORBARS   = 'boxerrorbars';
		const PLOTSTYLE_BOXES          = 'boxes';
		const PLOTSTYLE_BOXPLOT        = 'boxplot';
		const PLOTSTYLE_BOXXYERRORBARS = 'boxxyerrorbars';
		const PLOTSTYLE_CANDLESTICKS   = 'candlesticks';
		const PLOTSTYLE_CIRCLES        = 'circles';
		const PLOTSTYLE_ELLIPSES       = 'ellipses';
		const PLOTSTYLE_DOTS           = 'dots';
		const PLOTSTYLE_FILLEDCURVES   = 'filledcurves';
		const PLOTSTYLE_FINANCEBARS    = 'financebars';
		const PLOTSTYLE_FSTEPS         = 'fsteps';
		const PLOTSTYLE_FILLSTEPS      = 'fillsteps';
		const PLOTSTYLE_HISTEPS        = 'histeps';
		const PLOTSTYLE_HISTOGRAM      = 'histogram';
		const PLOTSTYLE_NEWHISTOGRAM   = 'newhistogram';
		const PLOTSTYLE_IMAGE          = 'image';
		const PLOTSTYLE_LABELS         = 'labels';
		const PLOTSTYLE_LINES          = 'lines';
		const PLOTSTYLE_LINESPOINTS    = 'linespoints';
		const PLOTSTYLE_PARALLELAXES   = 'parallelaxes';
		const PLOTSTYLE_POINTS         = 'points';
		const PLOTSTYLE_POLAR          = 'polar';
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

		const UNIT_NONE = '';
		const UNIT_INCH = 'in';
		const UNIT_CM   = 'cm';

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
		/* END - Class constants */

		/* INI - Object properties */
		private $background_color;
		private $box_width;
		private $canvas_height;
		private $canvas_width;
		private $font_face;
		private $font_size;
		private $graph_scale_x;
		private $graph_scale_y;
		private $key_align;
		private $key_position;
		private $key_style;
		private $key_valign;
		private $linestyle_color;
		private $linestyle_dashtype;
		private $linestyle_pointtype;
		private $linestyle_width;
		private $plotstyle;
		private $terminal;
		private $time_format;
		private $title;
		private $title_font_face;
		private $title_font_size;
		private $unit;
		private $x_label;
		private $y_label;

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
				case 'box_width':
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
				case 'linestyle_color':
				case 'linestyle_dashtype':
				case 'linestyle_pointtype':
				case 'linestyle_width':
				case 'plotstyle':
				case 'terminal':
				case 'time_format':
				case 'title':
				case 'title_font_face':
				case 'title_font_size':
				case 'unit':
				case 'x_label':
				case 'y_label':
					return $this->$name;
					break;
			}
		}

		public function __set( $name, $value ) {
			switch ( $name ) {
				case 'key_align':
					switch ( $value ) {
						case self::KEY_ALIGN_CENTER:
						case self::KEY_ALIGN_LEFT:
						case self::KEY_ALIGN_RIGHT:
							break;
						default:
							$value = self::KEY_ALIGN_RIGHT;
							break;
					}$this->key_align = $value;
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
						case self::PLOTSTYLE_BOXPLOT:
						case self::PLOTSTYLE_BOXXYERRORBARS:
						case self::PLOTSTYLE_CANDLESTICKS:
						case self::PLOTSTYLE_CIRCLES:
						case self::PLOTSTYLE_ELLIPSES:
						case self::PLOTSTYLE_DOTS:
						case self::PLOTSTYLE_FILLEDCURVES:
						case self::PLOTSTYLE_FINANCEBARS:
						case self::PLOTSTYLE_FSTEPS:
						case self::PLOTSTYLE_FILLSTEPS:
						case self::PLOTSTYLE_HISTEPS:
						case self::PLOTSTYLE_HISTOGRAM:
						case self::PLOTSTYLE_NEWHISTOGRAM:
						case self::PLOTSTYLE_IMAGE:
						case self::PLOTSTYLE_LABELS:
						case self::PLOTSTYLE_LINES:
						case self::PLOTSTYLE_LINESPOINTS:
						case self::PLOTSTYLE_PARALLELAXES:
						case self::PLOTSTYLE_POINTS:
						case self::PLOTSTYLE_POLAR:
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
						case self::TERMINAL_CANVAS:
						case self::TERMINAL_DUMB:
						case self::TERMINAL_GIF:
						case self::TERMINAL_JPEG:
						case self::TERMINAL_PDFCAIRO:
						case self::TERMINAL_PDF:
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
						case self::UNIT_NONE:
						case self::UNIT_CM:
						case self::UNIT_INCH:
							break;
						default:
							$value = self::UNIT_NONE;
							break;
					}
					$this->unit = $value;
					break;
				case 'graph_scale_x':
				case 'graph_scale_y':
					if ( strpos($value, '%') ) { $value = (int)$value / 100.0; }
				case 'box_width':
				case 'canvas_height':
				case 'canvas_width':
				case 'font_size':
				case 'title_font_size':
					$value = abs($value);
				case 'background_color':
				case 'font_face':
				case 'linestyle_color':
				case 'linestyle_dashtype':
				case 'linestyle_pointtype':
				case 'linestyle_width':
				case 'time_format':
				case 'title':
				case 'title_font_face':
				case 'x_label':
				case 'y_label':
					$this->$name = $value;
					break;
			}
		}
		/* END - Magic methods */

		/* INI - Private methods */
		private function ___enqueue_command( $command ) {
			if ( is_string($command) ) { $command = [ $command ]; }
			$this->___command_queue = array_merge($this->___command_queue, $command);
		}

		private function ___execute_queue( $flush = true ) {
			$command_queue = implode(' ; ', $this->___command_queue);
			if ( $flush ) { $this->___command_queue = []; }
			return shell_exec($this->___gnuplot_binary.' -e \''.str_replace("'", "\'", $command_queue).'\'');
		}

		private function ___init_data_tmpfile ( $data = [] ) {
			if ( !$this->___validate_data($data) ) { trigger_error('Invalid data for plotstyle "'.$this->plotstyle.'"', E_USER_ERROR); exit;  }
			if ( !($this->___data_tmpfile = tempnam(sys_get_temp_dir(), 'DAT')) ) { trigger_error('Failed creating temp data file', E_USER_ERROR); exit; }
			if ( $fp = fopen($this->___data_tmpfile, 'w') ) {
				foreach ( $data as $row ) { fwrite($fp, implode("\t", $row).PHP_EOL); }
				fclose($fp);
			}
		}

		private function ___init_data_plot( $extra_commands = [] ) {
			$command_queue = [
				 'set term '.$this->terminal.' size '.$this->canvas_width.','.$this->canvas_height
				,'set size '.$this->graph_scale_x.','.$this->graph_scale_y
				,'set style data '.$this->plotstyle
			];
			if ( self::KEY_POSITION_UNSET == $this->key_position ) { $command_queue[] = 'unset key'; }
			else { $command_queue[] = 'set key '.$this->key_position.' '.$this->key_align.' '.$this->key_valign.' '.$this->key_style; }
			if ( $this->title ) { $command_queue[] = 'set title "'.$this->title.'" font "'.$this->title_font_face.','.$this->title_font_size.'"'; }
			$this->___enqueue_command($command_queue);
		}

		private function ___validate_data( $data ) {
			// TO-DO: validate data for each plot style
			return true;
		}
		/* END - Private methods */

		/* INI - Public methods */
		public function reset() {
			$this->background_color    = '#ffffff';
			$this->canvas_height       = 480;
			$this->canvas_width        = 640;
			$this->font_face           = 'sans';
			$this->font_size           = 10;
			$this->graph_scale_x       = 1;
			$this->graph_scale_y       = 1;
			$this->key_align           = self::KEY_ALIGN_RIGHT;
			$this->key_position        = self::KEY_POSITION_INSIDE;
			$this->key_style           = self::KEY_STYLE_BOX;
			$this->key_valign          = self::KEY_VALIGN_TOP;
			$this->linestyle_color     = false;
			$this->linestyle_dashtype  = false;
			$this->linestyle_pointtype = false;
			$this->plotstyle           = self::PLOTSTYLE_LINES;
			$this->linestyle_width     = false;
			$this->terminal            = self::TERMINAL_PNGCAIRO;
			$this->time_format         = '%Y-%m-%d';
			$this->title               = '';
			$this->title_font_face     = 'sans';
			$this->title_font_size     = 14;
			$this->unit                = self::UNIT_NONE;
			$this->x_label             = '';
			$this->y_label             = '';

			$this->___command_queue    = [];
		}

		public function plot_data( $data, $extra_commands = [] ) {
			$this->___init_data_tmpfile($data);
			$this->___init_data_plot();
			$this->___enqueue_command(array_merge($extra_commands, [ 'plot "'.$this->___data_tmpfile.'"' ]));
			return $this->___execute_queue();
		}
		/* END - Public methods */

	}
