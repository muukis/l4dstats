<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->config['title']; ?> - <?php echo $this->step['name']; ?></title>
<link type="text/css" rel="stylesheet" href="views/<?php echo $this->config['view']; ?>/media/style.css" />
</head>
<body>
<div id="container">
	<div id="page">
		<div id="header">
			<h1><?php echo $this->config['title']; ?></h1>
			<p><?php echo $this->config['description']; ?></p>
		</div>
		<div id="content">
			<div class="progress">
				<?php echo ($this->config['show_steps'] ? 'Step ' . $this->vars['step_num'] . ' out of ' . $this->vars['total_steps'] . ' - ' : '') . $this->step['name']; ?>
			</div>
			<?php if ( isset($this->vars['error']) && $this->vars['error'] ): ?>
				<div class="error"><?php echo $this->vars['error']; ?></div>
			<?php endif; ?>
			<form action="" method="post" name="wizard">
				<div class="sections">
					<?php if ( isset($this->step['fields']) && $this->step['fields'] ): ?>
						<?php foreach ( $this->step['fields'] as $field ): ?>
							<?php if ( $field['type'] == 'info' ): ?>
								<div class="info"><?php echo $field['value']; ?></div>
							<?php elseif ( $field['type'] == 'header' ): ?>
								<h2><?php echo $field['value']; ?></h2>
							<?php elseif ( $field['type'] == 'php-config' ): ?>
								<h2><?php echo $field['label']; ?></h2>
								<div class="grid">
									<?php $idx = 0; foreach ( $field['items'] as $key => $value ): ?>
										<div class="<?php echo !$idx ? 'first ' : ''; echo ($idx++)%2 ? 'even' : 'odd'; ?>">
											<label><?php echo is_array($value) && isset($value[1]) ? $value[1] : $key; ?></label>
											<div class="value">
												<?php echo $field['value'][$key]['value']; ?>
												<span class="<?php echo $field['value'][$key]['error'] ? "fail" : "pass"; ?>">
													<?php echo $field['value'][$key]['message']; ?>
												</span>
											</div>
											<div class="clear"></div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php elseif ( $field['type'] == 'php-modules' ): ?>
								<h2><?php echo $field['label']; ?></h2>
								<div class="grid">
									<?php $idx = 0; foreach ( $field['items'] as $key => $value ): ?>
										<div class="<?php echo !$idx ? 'first ' : ''; echo ($idx++)%2 ? 'even' : 'odd'; ?>">
											<label><?php echo is_array($value) && isset($value[1]) ? $value[1] : $key; ?></label>
											<div class="value">
												<?php echo $field['value'][$key]['value']; ?>
												<?php if ( $field['value'][$key]['error'] ): ?>
													<span class="fail">
														<?php echo $field['value'][$key]['message']; ?>
													</span>
												<?php endif; ?>
											</div>
											<div class="clear"></div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php elseif ( $field['type'] == 'file-permissions' ): ?>
								<h2><?php echo $field['label']; ?></h2>
								<div class="grid widegrid">
									<?php $idx = 0; foreach ( $field['items'] as $key => $value ): ?>
										<div class="<?php echo !$idx ? 'first ' : ''; echo ($idx++)%2 ? 'even' : 'odd'; ?>">
											<label><?php echo $field['value'][$key]['path']; ?></label>
											<div class="value">
												<?php if ( !$field['value'][$key]['error'] ) echo $field['value'][$key]['value']; ?>
												<span class="<?php echo $field['value'][$key]['error'] ? "fail" : "pass"; ?>">
													<?php echo $field['value'][$key]['message']; ?>
												</span>
											</div>
											<div class="clear"></div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php else: ?>
								<div class="row">
									<label for="field_<?php echo $field['name']; ?>" <?php if ( isset($field['error']) && $field['error'] && (!isset($field['highlight_on_error']) || $field['highlight_on_error']) ): ?>class="error"<?php endif; ?>>
										<?php echo $field['label']; ?>
										<?php if ( isset($field['required']) && $field['required'] ): ?><i>*</i><?php endif; ?>
									</label>
									<div class="field">
										<?php if ( $field['type'] == 'text' ): ?>
											<input type="text" id="field_<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>" value="<?php echo isset($field['value']) ? htmlentities($field['value'], ENT_QUOTES, 'UTF-8') : ''; ?>" <?php echo $this->parse_attributes(isset($field['attributes']) ? $field['attributes'] : array(), array('class' => 'text')); ?> />
										<?php elseif ( $field['type'] == 'textarea' ): ?>
											<textarea id="field_<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>" <?php echo $this->parse_attributes(isset($field['attributes']) ? $field['attributes'] : array(), array('class' => 'textarea')); ?>><?php echo isset($field['value']) ? htmlentities($field['value'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
										<?php elseif ( $field['type'] == 'select' ): ?>
											<select id="field_<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>" <?php echo $this->parse_attributes(isset($field['attributes']) ? $field['attributes'] : array(), array('class' => 'select')); ?>>
												<?php foreach ( $field['items'] as $key => $value ): ?>
													<option value="<?php echo htmlentities($key, ENT_QUOTES, 'UTF-8'); ?>" <?php echo isset($field['value']) && $field['value'] == $key ? 'selected="selected"' : ''; ?>><?php echo htmlentities($value, ENT_QUOTES, 'UTF-8'); ?></option>
												<?php endforeach; ?>
											</select>
										<?php elseif ( $field['type'] == 'checkbox' ): ?>
											<ul class="items">
												<?php $i = 0; foreach ( $field['items'] as $key => $value ): ?>
													<li>
														<label>
															<input type="checkbox" id="field_<?php echo $field['name']; ?>_<?php echo $i++; ?>" name="<?php echo $field['name']; ?>[]" class="checkbox" value="<?php echo htmlentities($key, ENT_QUOTES, 'UTF-8'); ?>" <?php echo isset($field['value']) && @in_array($key, $field['value']) ? 'checked="checked"' : '' ?>>
															<?php echo $value; ?>
														</label>
													</li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
								</div>
								<div class="clear"></div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="buttons">
					<?php if ( $this->config['show_back_button'] && $this->vars['step_num'] > 1 && $this->vars['step_num'] != $this->vars['total_steps'] ): ?>
						<input type="submit" name="button_back" value="Back" class="button button-back" />
					<?php endif; ?>
					<?php if ( $this->vars['step_num'] < $this->vars['total_steps'] ): ?>
						<input type="submit" name="button_next" value="Next" class="button button-next" />
					<?php endif; ?>
					<?php if ( $this->vars['total_steps'] == 1 ): ?>
						<input type="submit" name="button_next" value="Done" class="button button-next" />
					<?php endif; ?>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="footer">
	<?php echo $this->config['copyright']; ?>
</div>
</body>
</html>