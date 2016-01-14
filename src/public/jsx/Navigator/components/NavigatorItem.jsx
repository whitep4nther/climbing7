
var ActionsCreator = require('../actions/ActionsCreator');

var NavigatorItem = React.createClass({
	render: function () {
		return (
			<div className="navigatorItem" onClick={ ActionsCreator.navigateToFolder.bind(ActionsCreator, this.props.data.id) }>{this.props.data.title}</div>
		);
	}
});

module.exports = NavigatorItem;