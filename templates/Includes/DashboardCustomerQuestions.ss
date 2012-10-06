<ul class="CustomerQuestions">
	<% if CustomerQuestions %>
		<% loop CustomerQuestions %>
			<li>
				<a href="$AnswerLink" class="ss-ui-button AnswerAction"><% _t('DashboardCustomerQuestions.ANSWER','Answer') %></a>
				<div class="question">
					$Title
				</div>
			</li>
		<% end_loop %>	
	<% else %>
		<li>
			<strong><% _t('DashboardCustomerQuestions.NOQUESTIONS','Great! nothing to answer :)') %></strong>
		</li>
	<% end_if %>
</ul>