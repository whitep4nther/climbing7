
var ItemList = React.createClass({
	getDefaultProps: function() {
	    return {
	    	click: function () {}
	    };
	},
	render: function () {
		var itemNodes = this.props.data.map(function (data) {
			var ClassItem = this.props.item;
			return (
				<ClassItem key={data.id} data={data} {...this.props.pass}/>
			);
		}.bind(this));

		return (
			<div className="navigatorList">
				{itemNodes}
			</div>
		);
	}
});

module.exports = ItemList;