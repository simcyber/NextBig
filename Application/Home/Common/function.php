<?php
function encode_password($in){
	return md5($in.md5("nexbig".$in));
}