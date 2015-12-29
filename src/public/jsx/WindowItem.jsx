
var WindowItem = React.createClass({

	click() {
		if (this.props.data.type == 'folder')
			this.props.folderClick(this.props.data.id);
		else
			this.props.fileClick();
	},

	render() {
		return (
			<div className="navigatorItem" onClick={this.click}>{this.props.data.title}</div>
		);
	}
});

module.exports = WindowItem;