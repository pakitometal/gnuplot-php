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

		const UNIT_NONE = '';
		const UNIT_INCH = 'in';
		const UNIT_CM   = 'cm';

		const LINETYPE_SOLID  = 'solid';
		const LINETYPE_DASHED = 'dashed';

		private $background_color;
		private $canvas_height;
		private $canvas_width;
		private $font_face;
		private $font_size;
		private $graph_scale_x;
		private $graph_scale_y;
		private $linetype_color;
		private $linetype;
		private $linetype_width;
		private $mode;
		private $time_format;
		private $title;
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
				case 'linetype':
					$value = ( self::LINETYPE_SOLID == $value || self::LINETYPE_DASHED == $value ) ? $value : self::LINETYPE_SOLID;
					break;
				case 'unit':
					$value = ( self::UNIT_NONE == $value || self::UNIT_CM == $value || self::UNIT_INCH == $value ) ? $value : self::UNIT_NONE;
					break;
				default:
					break;
			}
			$this->$name = $value;
		}

		public function reset() {
			$this->background_color = '#ffffff';
			$this->canvas_height    = 480;
			$this->canvas_width     = 640;
			$this->font_face        = 'sans';
			$this->font_size        = 10;
			$this->graph_scale_x    = 1;
			$this->graph_scale_y    = 1;
			$this->linetype_color   = [];
			$this->linetype         = self::LINETYPE_SOLID;
			$this->linetype_width   = [];
			$this->style            = 'line';
			$this->time_format      = '%Y-%m-%d';
			$this->title            = '';
			$this->unit             = self::UNIT_NONE;
			$this->x_label          = '';
			$this->y_label          = '';
		}

		public function command( $command = '' ) {
			fwrite($this->stdin, $command.PHP_EOL);
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


	}
