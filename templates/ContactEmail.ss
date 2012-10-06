<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<% base_tag %>
</head>
<body BGCOLOR="#EEEEEE">
	<center>
	<table width="500" style="padding:60px;padding-top:50px;" background="$BaseHREF/CustomerQuestions/images/email-bg.png">
		<tr>
			<td>
				<a href="$BaseHREF"><img src="$BaseHREF/mysite/images/logo.png" width="90px"/></a><br />
					<h1 style="font-size:16px;color:#666;margin-top:10px;"><% _t('QuickEmailForm.FROMOURWEBSITE','Contact from our website') %></h1>
			</td>	
		</tr>
		<tr>
			<td>
				<ul style="list-style:none;margin:0;margin-right:20px;padding:5px;background:#F4F4F4;">
					<li style="margin:5px;padding:0px;"><p><% _t('ContactEmail.SUBMITTERINFO','The following message was submitted to your site by') %> <strong>$Name</strong>:</li>
					<li style="margin:5px;padding:0px;"><p><% _t('QuickEmailForm.QUESTION','Question') %>: $Question</p></li>
					<li style="margin:5px;padding:0px;"><p><% _t('QuickEmailForm.EMAIL','Email') %>: $Email</p></li>
					<li style="margin:5px;padding:0px;">
						<p>
							<a href="admin/customer-questions/CustomerQuestion/EditForm/field/CustomerQuestion/item/{$CustomerQuestionID}/edit">
								<% _t('ContactEmail.ANSWERFROMCMS','Answer this email directly from your cms <br />(to keep track of your answer)') %>
							</a>
						</p>
					</li>
				</ul>
				
			</td>
		</tr>
	
	</table>
</center>
</body>
</html>