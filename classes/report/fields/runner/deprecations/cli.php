<?php

namespace mageekguy\atoum\deprecated\report\fields\runner\deprecations;

use
	mageekguy\atoum,
	mageekguy\atoum\locale,
	mageekguy\atoum\cli\prompt,
	mageekguy\atoum\cli\colorizer,
	mageekguy\atoum\report\fields\runner\outputs
;

class cli extends outputs
{
	protected $titlePrompt = null;
	protected $titleColorizer = null;
	protected $methodPrompt = null;
	protected $methodColorizer = null;
	protected $outputPrompt = null;
	protected $outputColorizer = null;

	protected $rescorer;

	public function __construct(atoum\deprecated\rescorer $rescorer)
	{
		parent::__construct();

		$this
			->setTitlePrompt()
			->setTitleColorizer()
			->setMethodPrompt()
			->setMethodColorizer()
			->setOutputPrompt()
			->setOutputColorizer()
		;

		$this->rescorer = $rescorer;
	}

	public function __toString()
	{
		$string = '';

		if ($this->runner !== null)
		{
			$outputs = $this->rescorer->getErrors();

			$sizeOfOutputs = sizeof($outputs);

			if ($sizeOfOutputs > 0)
			{
				$string .=
					$this->titlePrompt .
					sprintf(
						$this->locale->_('%s:'),
						$this->titleColorizer->colorize(sprintf($this->locale->__('There is %d depreciation notice', 'There are %d depreciations notices', $sizeOfOutputs), $sizeOfOutputs))
					) .
					PHP_EOL
				;

				foreach ($outputs as $output)
				{
					$string .= $this->methodPrompt . sprintf('%s:', $this->methodColorizer->colorize(sprintf($this->locale->_('In %s::%s()'), $output['class'], $output['method']))) . PHP_EOL;

					foreach (explode(PHP_EOL, rtrim($output['message'])) as $line)
					{
						$string .= $this->outputPrompt . $this->outputColorizer->colorize($line) . PHP_EOL;
					}
				}
			}
		}

		return $string;
	}

	public function setTitlePrompt(prompt $prompt = null)
	{
		$this->titlePrompt = $prompt ?: new prompt();

		return $this;
	}

	public function getTitlePrompt()
	{
		return $this->titlePrompt;
	}

	public function setTitleColorizer(colorizer $colorizer = null)
	{
		$this->titleColorizer = $colorizer ?: new colorizer();

		return $this;
	}

	public function getTitleColorizer()
	{
		return $this->titleColorizer;
	}

	public function setMethodPrompt(prompt $prompt = null)
	{
		$this->methodPrompt = $prompt ?: new prompt();

		return $this;
	}

	public function getMethodPrompt()
	{
		return $this->methodPrompt;
	}

	public function setMethodColorizer(colorizer $colorizer = null)
	{
		$this->methodColorizer = $colorizer ?: new colorizer();

		return $this;
	}

	public function getMethodColorizer()
	{
		return $this->methodColorizer;
	}

	public function setOutputPrompt(prompt $prompt = null)
	{
		$this->outputPrompt = $prompt ?: new prompt();

		return $this;
	}

	public function getOutputPrompt()
	{
		return $this->outputPrompt;
	}

	public function setOutputColorizer(colorizer $colorizer = null)
	{
		$this->outputColorizer = $colorizer ?: new colorizer();

		return $this;
	}

	public function getOutputColorizer()
	{
		return $this->outputColorizer;
	}
}
