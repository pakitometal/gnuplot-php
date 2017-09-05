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

	namespace pakitometal;
	class gnuplotPHP {

		const GNUPLOT_BINARY = '/usr/bin/gnuplot';

		const TERMINAL_CANVAS   = 'canvas';
		const TERMINAL_DUMB     = 'dumb';
		const TERMINAL_GIF      = 'gif';
		const TERMINAL_JPEG     = 'jpeg';
		const TERMINAL_PDFCAIRO = 'pdfcairo';
		const TERMINAL_PNG      = 'png';
		const TERMINAL_PNGCAIRO = 'pngcairo';
		const TERMINAL_SVG      = 'svg';

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
		private $terminal;
		private $time_format;
		private $title;
		private $title_font_face;
		private $title_font_size;
		private $unit;
		private $x_label;
		private $y_label;

		private $___gnuplot_binary  = null;
		private $___gnuplot_proc    = null;
		private $___stdin           = null;
		private $___stdout          = null;
		private $___stderr          = null;
		private $___tmpfile         = null;

		public function __construct( $gnuplot_binary = false ) {
			if ( !$gnuplot_binary ) { $this->___gnuplot_binary = self::GNUPLOT_BINARY; }
			$this->reset();
			$this->___set_pipes();
		}

		public function __destruct() {
			$this->command('quit');
			proc_close($this->___gnuplot_proc);
			unlink($this->___tmpfile);
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

		private function ___set_pipes() {
			$descriptorspec = [
				 [ 'pipe', 'r' ]
				,[ 'pipe', 'w' ]
				,[ 'pipe', 'r' ]
			];
			if ( !($this->___gnuplot_proc = proc_open($this->___gnuplot_binary, $descriptorspecs, $pipes, sys_get_temp_dir())) ) { throw new Exception('Unable to run gnuplot'); }
			$this->___stdin  = $pipes[0];
			$this->___stdout = $pipes[1];
			$this->___stderr = $pipes[2];
		}

		private function ___init_plot( $data, $extra_commands = [] ) {
			$plot_script = [
				 'set term '.$this->terminal.' size '.$this->canvas_width.','.$this->canvas_height
				,'set size '.$this->graph_scale_x.','-$this->graph_scale_y
			];
			if ( self::KEY_POSITION_UNSET == $this->key_position ) { $plot_script[] = 'unset key'; }
			else { $plot_script[] = 'set key '.$this->key_position.' '.$this->key_align.' '.$this->key_valign.' '.$this->key_style; }
			if ( $this->title ) { $plot_script[] = 'set title "'.$this->title.'" font "'.$this->title_font_face.','.$this->title_font_size.'"'; }
			if ( is_string($extra_commands) ) { $extra_commands = [ $extra_commands ]; }
			$plot_script = array_merge($plot_script, $extra_commands);
			$output = $this->command($plot_script);
			if ( $error = stream_get_contents($this->___stderr) ) { trigger_error($error, E_USER_ERROR); exit; }
			$this->___tmpfile = $this->init_tmpfile($data);
			return $output;
		}

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
			$this->linestyle_width     = false;
			$this->terminal            = self::TERMINAL_PNGCAIRO;
			$this->time_format         = '%Y-%m-%d';
			$this->title               = '';
			$this->title_font_face     = 'sans';
			$this->title_font_size     = 14;
			$this->unit                = self::UNIT_NONE;
			$this->x_label             = '';
			$this->y_label             = '';
		}

		public function command( $command ) {
			if ( is_array($command) ) { $command = implode(PHP_EOL, $command); }
			fwrite($this->stdin, $command.PHP_EOL);
			return stream_get_contents($this->___stdout);
		}

		public function init_tmpfile ( $data = [] ) {
			if ( !($data_tmpfile = tempnam(sys_get_temp_dir(), 'DAT')) ) { trigger_error('Failed creating temp data file', E_USER_ERROR); exit; }
			if ( $fp = fopen($data_tmpfile, 'w') ) {
				foreach ( $data as $row ) { fwrite($fp, implode('\t', $row).PHP_EOL); }
				fclose($fp);
			}
			$this->data_tmpfile = $data_tmpfile;
		}

		/***********************************************************/
		/***********************************************************/
		/***********************************************************/
	    public function plot( $plot_command ) {
			fflush($this->___stdout);
			fwrite($this->stdin, $plot_command.PHP_EOL);
			$result = '';
			$timeout = 100;
			do {
				stream_set_blocking($this->___stdout, false);
				$data = fread($this->___stdout, 128);
				$result .= $data;
				usleep(5000);
				$timeout -= 5;
			} while ( $timeout > 0 || $data );
			return $result;
		}
		/***********************************************************/
		/***********************************************************/
		/***********************************************************/

		public function plot_boxerrorbars( $data, $extra_commands = [] ) {
			$this->___init_plot($data, $extra_commands);
			$plot_command = 'plot "'.$data_file.'" with boxerrorbars';
			$this->plot($plot_command);
		}

		public function plot_boxes( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_boxplot( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_boxxyerrorbars( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_candlesticks ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_circles ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_dots ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_ellipses ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_filledcurves ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_fillsteps ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_financebars ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_fsteps ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_histeps ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_histogram ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_image ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_labels ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_lines ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_linespoints ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_newhistogram ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_parallelaxes ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_points ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_polar ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_rgbalpha ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_rgbimage ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_steps ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_vectors ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_xerrorbars ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_xerrorlines ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_xyerrorbars ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_xyerrorlines ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_yerrorbars ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

		public function plot_yerrorlines ( $data ) {
			$plot_command = [];
			$this->___init_plot($data, $extra_commands);
		}

	}
