<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<% base_tag %>
</head>
<body BGCOLOR="#EEEEEE">
	<center>
	<table width="600" height="745" style="padding:60px;padding-top:30px;" background="$BaseHREF/CustomerQuestions/images/email-bg.png">
		<tr valign="top">
			<td>
				<a href="$BaseHREF"><img src="$BaseHREF/mysite/images/logo.png" /></a><br /><br />
				<h1 style="font-size:16px;color:#666;margin-top:10px;"><% _t('ContactAnswer.ANSWER','Here is your Answer!') %></h1>

				<hr /><br /><br />
				<ul style="list-style:none;margin:0;margin-right:20px;padding:5px;background:#F4F4F4;">
					<li style="margin:5px;padding:0px;"><p>$Body</p></li>
				</ul>
			</td>
		</tr>
	</table>
</center>
</body>
</html>