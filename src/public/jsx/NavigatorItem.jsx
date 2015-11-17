var NavigatorItem = React.createClass({
	render: function () {
		return (
			<li onClick={this.props.onClick}>{this.props.item.title}</li>
		);
	}
});

module.exports = NavigatorItem;