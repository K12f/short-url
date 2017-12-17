<?php

/**
 * 短url生成
 * Class ShortUrl
 */
class ShortUrl
{
	const CHARS = [
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
		'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
		'U', 'V', 'W', 'X', 'Y', 'Z',
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
		'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
		'u', 'v', 'w', 'x', 'y', 'z',
		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
		'.',
	];
	const RADIX = 63;
	
	/**
	 * 十进制->63进制
	 * @param int $dec
	 * @return string
	 */
	public function decToBase63(int $dec): string
	{
		$ret = [];
		do {
			//取到的模值
			$remainder = $dec % static::RADIX;
			//插入数组开头
			array_unshift($ret, static::CHARS[$remainder]);
			//除
			$dec = (int)($dec / static::RADIX);
		} while ($dec !== 0);
		//数组数量不够5个就填充 字符A
		$ret = array_pad($ret, -5, 'A');
		//打乱排序，存储到表中，防止猜到id值。
//		shuffle($ret);
		return join('', $ret);
	}
	
	/**
	 * 63进制->10进制
	 * @param string $base63
	 * @return int
	 */
	public function base63ToDec(string $base63): int
	{
		$ret = 0;
		$len = strlen($base63);
		for ($i = 0; $i < $len; $i++) {
			$ret += array_search($base63[$i], static::CHARS)*static::RADIX ** ($len - ($i+1));
		}
		return $ret;
	}
}
