# SEB-PP - Simple Ethereum Blockchain PHP Parser

SEB-PP is a **S**imple **E**thereum **B**lockchain **P**HP **P**arser to extract (from->to) transaction information from Ethereum Blockchain, requiring very little memory and software dependencies. SEB-PP uses JSON-RPC API of geth to get information from the local node, without depending any third-party online blockchain API and its limits.

SEB-PP is designed with simplicity and ease-of-use in mind! 

### Installation

SEB-PP has developed to work with minimal dependencies and requires only [PHP](http://php.net/) and command line [cURL](https://curl.haxx.se/) to run, e.g. on Ubuntu, the following would work: 

```sh
$ sudo apt-get install php curl
$ php SEB-PP.php
```

FAQ: Why are you not using cURL functions inside PHP, but rather running cURL externally? This way it does not depend on modules and in case standard PHP and cURL are installed, it is possible just to run it from non-administrative rights.

### Configuration

* geth needs to be started with --rpc
* edit SEB-PP.php and modify $host and $port parameters, default setup is localhost:8545


### Running the parser

Simple test if parser works, should print out first and last block information:
```sh
$ php SEB-PP.php
```

Prints out all transactions for [blockNumber]:
```sh
$ php SEB-PP.php [blockNumber]
```

Prints out all transactions from [fromBlock] to [toBlock]:
```sh
$ php SEB-PP.php [fromBlock] [toBlock]
```

### Example of output

Example:
```sh
$ php SEB-PP.php 46147
```
Prints out comma separated values (fromAddress,toAddress,value,blocknumber,timestamp):
```
0xa1e4380a3b1f749673e270229993ee55f35663b4,0x5df9b87991262f6ba471f09758cde1c0fc1de734,0.000000000000031,46147,1438918233
```

Another example:
```sh
$ php SEB-PP.php 46000 46200
```
Prints out comma separated values (fromAddress,toAddress,value,blocknumber,timestamp):
```
0xa1e4380a3b1f749673e270229993ee55f35663b4,0x5df9b87991262f6ba471f09758cde1c0fc1de734,0.000000000000031,46147,1438918233
0xbd08e0cddec097db7901ea819a3d1fd9de8951a2,0x5c12a8e43faf884521c2454f39560e6c265a68c8,19.899999999999999,46169,1438918613
0x63ac545c991243fa18aec41d4f6f598e555015dc,0xc93f2250589a6563f5359051c1ea25746549f0d8,599.989500000000021,46170,1438918630
0x037dd056e7fdbd641db5b6bea2a8780a83fae180,0x7e7ec15a5944e978257ddae0008c2f2ece0a6090,100.000000000000000,46194,1438918983

```


### Development

Want to contribute? You're welcome!

License
----
GPLv2

