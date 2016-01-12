
var WindowItem = React.createClass({

	getInitialState() {
		return ({
			editing: false
		});
	},

	editTitle() {
		this.setState({
			editing: true
		});
	},
	onKeyDown(e) {
		if (e.keyCode == 13)
			this.setState({
				editing: false
			});
	},

	click() {
		if (this.props.data.type == 'folder')
			this.props.folderClick(this.props.data.id);
		else
			this.props.fileClick(this.props.data);
	},

	render() {
		var title = (this.state.editing)
				? <input type="text" autoFocus onKeyDown={this.onKeyDown} ref={function (input) { if (input) { input.setSelectionRange(input.value.length, input.value.length); } }} value={this.props.data.title}/>
				: <p className="title" onClick={this.editTitle}>{this.props.data.title}</p>;

		return (
			<div className="windowItem">
				<div className="icon" onClick={this.click}>
				</div>
				{title}
			</div>
		);
	}
});

module.exports = WindowItem;