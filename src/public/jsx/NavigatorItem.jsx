
var NavigatorItem = React.createClass({
	render: function () {
		return (
			<div className="navigatorItem" onClick={withArgs(this.props.click, [this.props.data.id])}>{this.props.data.title}</div>
		);
	}
});

module.exports = NavigatorItem;