<ul class="CustomerQuestions">
	<% loop CustomerQuestions %>
	<li>
		
		<a href="$AnswerLink" class="ss-ui-button AnswerAction"><% _t('DashboardCustomerQuestions.ANSWER','Answer') %></a>
		$Title
	</li>
	<% end_loop %>
</ul>