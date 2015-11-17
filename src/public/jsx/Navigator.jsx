
var NavigatorItemList = require('./NavigatorItemList.jsx');

window.Navigator = React.createClass({
	getInitialState: function () {
		return {
			navigatorItems: [],
			windowItems: []
		};
	},

	componentDidMount: function () {
		$.getJSON(ROOT + '/library/folders')
		.done(function (json) {
			this.setState({
				navigatorItems: json
			});
		}.bind(this));
	},

	loadFolder: function (id) {
		$.getJSON(ROOT + '/library/folder/'+ id)
		.done(function (json) {
			this.setState({
				windowItems: json
			});
		}.bind(this));
	},
	render: function () {

		return (
			<div id="navigator">
				<div id="leftPanel">
					<NavigatorItemList data={this.state.navigatorItems} click={this.loadFolder} />
				</div>
				<div id="window">
					<NavigatorItemList data={this.state.windowItems}/>
				</div>
			</div>
		);
	}
});