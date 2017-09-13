<?PHP

// SEB-PP - Simple Ethereum Blockchain PHP Parser v0.2-alpha
// Written by: Innar Liiv (September 12, 2017)

$host="localhost"; // Which host to connect?
$port="8545";      // Which port to connect?

if ((@$argv[1]=="" && @$argv[2]=="") || @$argv[1]=="help" || @$argv[1]=="-h" || @$argv[1]=="--help") {

echo "SEB-PP - Simple Ethereum Blockchain PHP Parser v0.2-alpha\n\n";
echo "usage: php SEB-PP.php \t\t\t\t\t Simple test if parser works, should print out first and last block information\n";
echo "usage: php SEB-PP.php [blockNumber]\t\t\t Prints out all transactions for [blockNumber]\n";
echo "usage: php SEB-PP.php [fromBlock] [toBlock]\t\t Prints out all transactions from [fromBlock] to [toBlock]\n\n";

exec("curl -s -X POST --data '{\"jsonrpc\":\"2.0\",\"method\":\"eth_getBlockByNumber\",\"params\":[\"earliest\", true],\"id\":1}' $host:$port",$json);
$first=json_decode($json[0],true);
$json=Array();
exec("curl -s -X POST --data '{\"jsonrpc\":\"2.0\",\"method\":\"eth_getBlockByNumber\",\"params\":[\"latest\", true],\"id\":1}' $host:$port",$json);
$last=json_decode($json[0],true);

echo "First block number (dec): ".hexdec($first["result"]["number"])."\n";
echo "First block number (hex): ".$first["result"]["number"]."\n";
echo "First block hash: ".$first["result"]["hash"]."\n";

echo "Last block number (dec): ".hexdec($last["result"]["number"])."\n";
echo "Last block number (hex): ".$last["result"]["number"]."\n";
echo "Last block hash: ".$last["result"]["hash"]."\n";

} else {

$fromBlock=@$argv[1];
$toBlock=@$argv[2];

if (@$argv[1]!="" & @$argv[2]=="") { $toBlock=$fromBlock; }

if ($fromBlock==$toBlock) { $toBlock++; } // to allow asking a single block

for ($i=$fromBlock;$i<$toBlock;$i++) {
  $json=Array();
  $block="0x".dechex($i);
  exec("curl -s -X POST --data '{\"jsonrpc\":\"2.0\",\"method\":\"eth_getBlockByNumber\",\"params\":[\"$block\",   true],\"id\":1}' $host:$port",$json);
  $result=json_decode($json[0],true);

  for ($j=0;$j<count($result["result"]["transactions"]);$j++) {
    echo $result["result"]["transactions"][$j]["from"]; // transaction: from
    echo ",";
    echo $result["result"]["transactions"][$j]["to"]; // transaction: to
    echo ",";
    echo number_format(hexdec($result["result"]["transactions"][$j]["value"])/1000000000000000000,15); // transaction: value in ETH
    echo ",";
    echo hexdec($result["result"]["number"]); // block number
    echo ",";
    echo hexdec($result["result"]["timestamp"]); // block timestamp
    echo "\n"; 
  }
}

}

?>
