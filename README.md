# short-url
#算法原理
###算法一
>1.将长网址md5生成32位签名串,分为4段, 每段8个字节; <br />
>2.对这四段循环处理, 取8个字节, 将他看成16进制串与0x3fffffff(30位1)与操作, 即超过30位的忽略处理;<br />
>3.这30位分成6段, 每5位的数字作为字母表的索引取得特定字符, 依次进行获得6位字符串;<br />
>4.总的md5串可以获得4个6位串; 取里面的任意一个就可作为这个长url的短url地址;<br />
这种算法,虽然会生成4个,但是仍然存在重复几率,下面的算法一和三,就是这种的实现.
<br />

###算法二

>1.a-zA-Z0-9 这64位取6位组合,可产生500多亿个组合数量.把数字和字符组合做一定的映射,就可以产生唯一的字符串,如第62个组合就是aaaaa9,第63个组合就是aaaaba,再利用洗牌算法，把原字符串打乱后保存，那么对应位置的组合字符串就会是无序的组合。<br />
>2.把长网址存入数据库,取返回的id,找出对应的字符串,例如返回ID为1，那么对应上面的字符串组合就是bbb,同理 ID为2时，字符串组合为bba,依次类推,直至到达64种组合后才会出现重复的可能，所以如果用上面的62个字符，任意取6个字符组合成字符串的话，你的数据存量达到500多亿后才会出现重复的可能。
具体参看这里彻底完善新浪微博接口和超短URL算法,算法四可以算作是此算法的一种实现,此算法一般不会重复,但是如果是统计的话,就有很大问题,特别是对域名相关的统计,就抓瞎了
