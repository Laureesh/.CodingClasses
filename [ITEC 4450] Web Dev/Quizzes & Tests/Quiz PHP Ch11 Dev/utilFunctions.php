<?php
	function htc($text) {
		return htmlspecialchars($text);
	}

	function addJS($text) {
		return "<script>".$text."</script>";
	}
?>

<script>
	function sortSelect(selElem) {
		var tmpAry = new Array();
		for (var i=0;i<selElem.options.length;i++) {
				tmpAry[i] = new Array();
				tmpAry[i][0] = selElem.options[i].text;
				tmpAry[i][1] = selElem.options[i].value;
		}
		tmpAry.sort();
		while (selElem.options.length > 0) {
				selElem.options[0] = null;
		}
		for (var i=0;i<tmpAry.length;i++) {
				var op = new Option(tmpAry[i][0], tmpAry[i][1]);
				selElem.options[i] = op;
		}
		return;
	}
		
	function removeOptions(selectbox)
	{
		var i;
		for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
		{
				selectbox.remove(i);
		}
	}
</script>