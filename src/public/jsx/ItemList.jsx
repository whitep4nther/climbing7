
var ItemList = React.createClass({
	getDefaultProps: function() {
	    return {
	    	click: function () {}
	    };
	},
	render: function () {
		var itemNodes = this.props.data.map(function (item) {
			var ClassItem = this.props.item;
			return (
				<ClassItem key={item.id} item={item} click={this.props.click(item)}/>
			);
		}.bind(this));

		return (
			<div className="navigatorList">
				{itemNodes}
			</div>
		);
	}
});

module.exports = NavigatorItemList;