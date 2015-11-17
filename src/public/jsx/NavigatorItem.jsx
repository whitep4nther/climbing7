
var NavigatorItem = React.createClass({
	render: function () {
		return (
			<div className="navigatorItem" onClick={this.props.onClick}>{this.props.item.title}</div>
		);
	}
});

module.exports = NavigatorItem;