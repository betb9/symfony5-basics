<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper {

	private $markdownParser;
	private $cache;

	/**
	 * MarkdownHelper constructor.
	 * @param MarkdownParserInterface $markdownParser
	 * @param CacheInterface $cache
	 */
	public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache) {
		$this->markdownParser = $markdownParser;
		$this->cache = $cache;
	}

	/**
	 * @param string $source
	 * @return string
	 * @throws InvalidArgumentException
	 */
	public function parse(string $source): string {
    return $this->cache->get('markdown_'.md5($source), function() use($source) {
      return $this->markdownParser->transformMarkdown($source);
    });
  }
}