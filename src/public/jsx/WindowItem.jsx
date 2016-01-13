
var classNames = require('classnames');

var WindowItem = React.createClass({

	click() {
		if (this.props.data.type == 'folder')
			this.props.folderClick(this.props.data.id);
		else
			this.props.fileClick(this.props.data);
	},

	render() {
		return (
			<div className={ classNames('windowItem', {'selected': this.props.isSelected(this.props.data)}) }>
				<div className="icon" onClick={this.click}>
				</div>
				<p className="title">{this.props.data.title}</p>
			</div>
		);
	}
});

module.exports = WindowItem;