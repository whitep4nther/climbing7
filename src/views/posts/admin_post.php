
	<img src="<?= asset('img/canyoning.jpg') ?>" style="display:block; width:175px;height:175px;border:2px solid white;position:absolute;z-index:10;top:265px;"/>

	<form method="POST" action="<?= $app->urlFor('postEdited', ['id' => $post['id']]) ?>">

		<div class="form-group">
			<label for="title">Titre</label>
			<input id="title" type="text" name="title" value="<?= $post['title'] ?>"/>
		</div>

		<div class="form-group">
			<label for="label">Label (~ 255 caractères)</label>
			<textarea id="label" name="label">
				<?= $post['label'] ?>
			</textarea>
		</div>

		<div class="form-group">
			<label for="category">Catégorie</label>
			<select id="category" name="category_id">
				<?php foreach ($categories as $category) {
					$selected = ''; 
					if ($post['category_id'] == $category['id'])
						$selected = 'selected="selected"';

				?>
				
				<option <?= $selected ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
				
				<?php } ?>
			</select>
		</div>

		<div class="form-group">
			<label for="country">Pays</label>
			<input id="country" type="text" name="country" value="<?= $post['country'] ?>"/>
		</div>

		<div class="form-group">
			<label for="region">Région</label>
			<input id="region" type="text" name="region" value="<?= $post['region'] ?>"/>
		</div>

		<div class="form-group">
			<label for="site">Site</label>
			<input id="site" type="text" name="site" value="<?= $post['site'] ?>"/>
		</div>

		<div class="form-group">
			<label for="rate">Note /5</label>
			<select id="rate" name="rate">
				<?php
				$text = '';
				for ($i = 0; $i < 5; $i++) {
					$text .= '★';
					$selected = $post['rate'] == $i + 1 ? 'selected="selected"' : '';
				?>
					<option <?= $selected ?> value="<?= $i ?>"><?= $text ?></option>
				<?php
				}
				?>
			</select>
		</div>

		<div class="form-group">
			<label for="presentation">Présentation</label>
			<textarea id="presentation" name="presentation">
				<?= $post['presentation'] ?>
			</textarea>
		</div>

		<div class="form-group">
			<label for="characteristics">Caractéristiques</label>
			<textarea id="characteristics" name="characteristics">
				<?= $post['characteristics'] ?>
			</textarea>
		</div>

		<div class="form-group">
			<label for="access">Accès</label>
			<textarea id="access" name="access">
				<?= $post['access'] ?>
			</textarea>
		</div>

		<div class="form-group">
			<label for="approach">Approche</label>
			<textarea id="approach" name="approach">
				<?= $post['approach'] ?>
			</textarea>
		</div>

		<div class="form-group">
			<label for="parcours">Parcours</label>
			<textarea id="parcours" name="parcours">
				<?= $post['parcours'] ?>
			</textarea>
		</div>

		<div class="form-group">
			<label for="back">Retour</label>
			<textarea id="back" name="back">
				<?= $post['back'] ?>
			</textarea>
		</div>

		<div class="form-group">
			<label for="date">Date</label>
			<input type="date" id="date" name="date" value="<?= $post['date'] ?>"/>
		</div>

		<input type="submit" value="Éditer"/>

	</form>