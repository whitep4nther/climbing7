
var NavigatorItem = require('./NavigatorItem.jsx');

var NavigatorItemList = React.createClass({
	getDefaultProps: function() {
	    return {
	    	click: function () {}
	    };
	},
	render: function () {
		var itemNodes = this.props.data.map(function (item) {
			return (
				<NavigatorItem key={item.id} item={item} onClick={this.props.click.arg(item.id)}/>
			);
		}.bind(this));

		return (
			<ul class="navigatorList">
				{itemNodes}
			</ul>
		);
	}
});

module.exports = NavigatorItemList;