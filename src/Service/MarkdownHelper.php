<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper {

	/**
	 * @var MarkdownParserInterface
	 */
	private $markdownParser;
	/**
	 * @var CacheInterface
	 */
	private $cache;
	/**
	 * @var bool
	 */
	private $isDebug;
	/**
	 * @var LoggerInterface
	 */
	private $mdLogger;

	/**
	 * MarkdownHelper constructor.
	 * @param MarkdownParserInterface $markdownParser
	 * @param CacheInterface $cache
	 * @param bool $isDebug
	 * @param LoggerInterface $mdLogger
	 */
	public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache, bool $isDebug, LoggerInterface $mdLogger) {
		$this->markdownParser = $markdownParser;
		$this->cache = $cache;
		$this->isDebug = $isDebug;
		$this->mdLogger = $mdLogger;
	}

	/**
	 * @param string $source
	 * @return string
	 * @throws InvalidArgumentException
	 */
	public function parse(string $source): string {
		if(stripos($source, 'cat') !== false) {
			$this->mdLogger->info('Meow!');
		}

		if(!$this->isDebug) {
			return $this->markdownParser->transformMarkdown($source);
		}
    return $this->cache->get('markdown_'.md5($source), function() use($source) {
      return $this->markdownParser->transformMarkdown($source);
    });
  }
}