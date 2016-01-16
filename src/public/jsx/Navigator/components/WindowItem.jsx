
var ActionsCreator = require('../actions/ActionsCreator');

var classNames = require('classnames');

var WindowItem = React.createClass({

	click() {
		if (this.props.data.type == 'folder')
			ActionsCreator.navigateToFolder(this.props.data.id);
		else
			ActionsCreator.clickedFile(this.props.data);
	},

	render() {
		return (
			<div className={ classNames('windowItem', {'selected': this.props.isSelected(this.props.data)}) } title={this.props.data.title}>
				<div className="icon" onClick={this.click}>
					<img src={MEDIA_DIR + this.props.data.full_path + '?height=100'}/>
					<p className="selected-message">✓</p>
				</div>
				<p className="title">{this.props.data.title}</p>
			</div>
		);
	}
});

module.exports = WindowItem;