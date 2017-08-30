<?php

	class gnuplotPHP {

		const GNUPLOT_BINARY = 'gnuplot';

		const TERMINAL_CANVAS   = 'canvas';
		const TERMINAL_DUMB     = 'dumb';
		const TERMINAL_GIF      = 'gif';
		const TERMINAL_JPEG     = 'jpeg';
		const TERMINAL_PDFCAIRO = 'pdfcairo';
		const TERMINAL_PNG      = 'png';
		const TERMINAL_SVG      = 'svg';

		const UNIT_NONE = '';
		const UNIT_INCH = 'in';
		const UNIT_CM   = 'cm';

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

		public function reset() {}

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
