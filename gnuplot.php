<?php

/**
* Copyright (C) 2017 Francisco Licerán Peralbo
* This file is part of gnuplotPHP.
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
**/

	class gnuplotPHP {

		const GNUPLOT_BINARY = 'gnuplot';

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

		const KEY_ALIGN_LEFT     = 'left';
		const KEY_ALIGN_RIGHT    = 'right';
		const KEY_ALIGN_CENTER   = 'center';
		const KEY_POSITION_UNSET = 'unset';
		const KEY_STYLE_BOX      = 'box';
		const KEY_STYLE_NOBOX    = 'nobox';

		private $background_color;
		private $box_width;
		private $canvas_height;
		private $canvas_width;
		private $font_face;
		private $font_size;
		private $graph_scale_x;
		private $graph_scale_y;
		private $key_position;
		private $key_align;
		private $key_style;
		private $linestyle_color;
		private $linestyle_dashtype;
		private $linestyle_pointtype;
		private $linestyle_width;
		private $plot_style;
		private $terminal;
		private $time_format;
		private $title;
		private $title_font_face;
		private $title_font_size;
		private $unit;
		private $x_label;
		private $y_label;

		private $gnuplot = null;
		private $stdin   = null;
		private $tdout   = null;
		private $tderr   = null;

		public function __construct() {
			$this->reset();
			$this->set_pipes();
		}

		public function __destruct() {
			$this->command('quit');
			proc_close($this->gnuplot);
		}

		public function __get( $name ) { return $this->$name; }

		public function __set( $name, $value ) {
			switch ( $name ) {
				case 'box_width':
				case 'canvas_height':
				case 'canvas_width':
				case 'font_size':
					$value = abs($value);
					break;
				case 'graph_scale_x':
				case 'graph_scale_y':
					if ( strpos($value, '%') ) { $value = (int)$value / 100.0; }
					$value = abs($value);
					break;
				case 'key_align':
					switch ( $value ) {
						case self::KEY_ALIGN_CENTER:
						case self::KEY_ALIGN_LEFT:
						case self::KEY_ALIGN_RIGHT:
							break;
						default:
							$value = self::KEY_ALIGN_LEFT;
							break;
					}
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
					break;
				case 'plot_style':
					switch ( $value ) {
						case PLOTSTYLE_BOXERRORBARS:
						case PLOTSTYLE_BOXES:
						case PLOTSTYLE_BOXPLOT:
						case PLOTSTYLE_BOXXYERRORBARS:
						case PLOTSTYLE_CANDLESTICKS:
						case PLOTSTYLE_CIRCLES:
						case PLOTSTYLE_ELLIPSES:
						case PLOTSTYLE_DOTS:
						case PLOTSTYLE_FILLEDCURVES:
						case PLOTSTYLE_FINANCEBARS:
						case PLOTSTYLE_FSTEPS:
						case PLOTSTYLE_FILLSTEPS:
						case PLOTSTYLE_HISTEPS:
						case PLOTSTYLE_HISTOGRAM:
						case PLOTSTYLE_NEWHISTOGRAM:
						case PLOTSTYLE_IMAGE:
						case PLOTSTYLE_LABELS:
						case PLOTSTYLE_LINES:
						case PLOTSTYLE_LINESPOINTS:
						case PLOTSTYLE_PARALLELAXES:
						case PLOTSTYLE_POINTS:
						case PLOTSTYLE_POLAR:
						case PLOTSTYLE_STEPS:
						case PLOTSTYLE_RGBALPHA:
						case PLOTSTYLE_RGBIMAGE:
						case PLOTSTYLE_VECTORS:
						case PLOTSTYLE_XERRORBARS:
						case PLOTSTYLE_XYERRORBARS:
						case PLOTSTYLE_YERRORBARS:
						case PLOTSTYLE_XERRORLINES:
						case PLOTSTYLE_XYERRORLINES:
						case PLOTSTYLE_YERRORLINES:
							break;
						default:
							$value = self::PLOTSTYLE_LINES;
							break;
					}
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
					break;
				default:
					break;
			}
			$this->$name = $value;
		}

		private function set_pipes() {
			$descriptorspec = [
				 [ 'pipe', 'r' ]
				,[ 'pipe', 'w' ]
				,[ 'pipe', 'r' ]
			];

			if ( !($this->gnuplot = proc_open(static::GNUPLOT_BINARY, $descriptorspecs, $pipes, sys_get_temp_dir())) ) { throw new Exception('Unable to run gnuplot'); }

			$this->stdin  = $pipes[0];
			$this->stdout = $pipes[1];
			$this->stderr = $pipes[2];
		}

		public function reset() {
			$this->background_color    = '#ffffff';
			$this->canvas_height       = 480;
			$this->canvas_width        = 640;
			$this->font_face           = 'sans';
			$this->font_size           = 10;
			$this->graph_scale_x       = 1;
			$this->graph_scale_y       = 1;
			$this->key_position        = '';
			$this->key_align           = self::KEY_ALIGN_LEFT;
			$this->key_style           = self::KEY_STYLE_BOX;
			$this->linestyle_color     = false;
			$this->linestyle_dashtype  = false;
			$this->linestyle_pointtype = false;
			$this->linestyle_width     = false;
			$this->plot_style          = self::PLOTSTYLE_LINES;
			$this->terminal            = self::TERMINAL_PNGCAIRO;
			$this->time_format         = '%Y-%m-%d';
			$this->title               = '';
			$this->title_font_face     = 'sans';
			$this->title_font_size     = 14;
			$this->title               = '';
			$this->unit                = self::UNIT_NONE;
			$this->x_label             = '';
			$this->y_label             = '';
		}

		public function command( $command = '' ) {
			fwrite($this->stdin, $command.PHP_EOL);
		}

		public function plot( $data ) {
			$plot_script = [
				 'set term '.$this->terminal.' size '.$this->canvas_width.','.$this->canvas_height
				,'set size '.$this->graph_scale_x.','-$this->graph_scale_y
			];
			if ( self::KEY_POSITION_UNSET == $this->key_position ) { $plot_script[] = 'unset key'; }
			if ( $this->title ) { $plot_script[] = 'set title "'.$this->title.'" font "'.$this->title_font_face.','.$this->title_font_size.'"'; }


			switch ( $this->plot_style ) {
				case PLOTSTYLE_BOXERRORBARS:
					break;
				case PLOTSTYLE_BOXES:
					break;
				case PLOTSTYLE_BOXPLOT:
					break;
				case PLOTSTYLE_BOXXYERRORBARS:
					break;
				case PLOTSTYLE_CANDLESTICKS:
					break;
				case PLOTSTYLE_CIRCLES:
					break;
				case PLOTSTYLE_ELLIPSES:
					break;
				case PLOTSTYLE_DOTS:
					break;
				case PLOTSTYLE_FILLEDCURVES:
					break;
				case PLOTSTYLE_FINANCEBARS:
					break;
				case PLOTSTYLE_FSTEPS:
					break;
				case PLOTSTYLE_FILLSTEPS:
					break;
				case PLOTSTYLE_HISTEPS:
					break;
				case PLOTSTYLE_HISTOGRAM:
					break;
				case PLOTSTYLE_NEWHISTOGRAM:
					break;
				case PLOTSTYLE_IMAGE:
					break;
				case PLOTSTYLE_LABELS:
					break;
				case PLOTSTYLE_LINES:
					break;
				case PLOTSTYLE_LINESPOINTS:
					break;
				case PLOTSTYLE_PARALLELAXES:
					break;
				case PLOTSTYLE_POINTS:
					break;
				case PLOTSTYLE_POLAR:
					break;
				case PLOTSTYLE_STEPS:
					break;
				case PLOTSTYLE_RGBALPHA:
					break;
				case PLOTSTYLE_RGBIMAGE:
					break;
				case PLOTSTYLE_VECTORS:
					break;
				case PLOTSTYLE_XERRORBARS:
					break;
				case PLOTSTYLE_XYERRORBARS:
					break;
				case PLOTSTYLE_YERRORBARS:
					break;
				case PLOTSTYLE_XERRORLINES:
					break;
				case PLOTSTYLE_XYERRORLINES:
					break;
				case PLOTSTYLE_YERRORLINES:
					break;
			}

			if ( $plot_command ) {
				$this->command($plot_command);
			}
		}

	}
