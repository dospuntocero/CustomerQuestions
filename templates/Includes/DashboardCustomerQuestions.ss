<ul class="CustomerQuestions">
	<% if  %>
		<% loop CustomerQuestions %>
			<li>
				<a href="$AnswerLink" class="ss-ui-button AnswerAction"><% _t('DashboardCustomerQuestions.ANSWER','Answer') %></a>
				$Title
			</li>
		<% end_loop %>	
	<% else %>
		<li>
			<strong><% _t('DashboardCustomerQuestions.NOQUESTIONS','Great! nothing to answer :)') %></strong>
		</li>
	<% end_if %>
</ul>