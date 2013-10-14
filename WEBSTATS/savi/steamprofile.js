/**
 *	This file is part of SteamProfile.
 *
 *	Written by Nico Bergemann <barracuda415@yahoo.de>
 *	Copyright 2009 Nico Bergemann
 *
 *	SteamProfile is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	SteamProfile is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with SteamProfile.  If not, see <http://www.gnu.org/licenses/>.
 */

jQuery.fn.attrAppend = function(name, value) {
	var elem;
	return this.each(function(){
		elem = $(this);
		
		// append attribute only if extisting and not empty
		if(elem.attr(name) != undefined && elem.attr(name) != "") {
			elem.attr(name, value + elem.attr(name));
		}
	});
};
 
$(document).ready(function() {
	SteamProfile = new SteamProfile();
	SteamProfile.init();
});

function SteamProfile() {
	var basePath;
	var themePath;
	var showGameBanner;
	var showSliderMenu;
	var profiles = new Array();
	var profileCache = new Object();
	var loadLock = false;
	var configLoaded = false;
	var configData;
	var profileTpl;
	var loadingTpl;
	var errorTpl;

	this.init = function() {
		// get our <script>-tag
		var scriptElement = $('script[src$=\'steamprofile.js\']');
		
		// in rare cases, this script could be included without <script>
		if(scriptElement.length == 0) {
			return;
		}
		
		// extract the path from the src attribute
		basePath = scriptElement.attr('src').replace('steamprofile.js', '');
		
		// load xml config
		jQuery.ajax({
			type: 'GET',
			url: basePath + 'steamprofile.xml',
			dataType: 'html',
			complete: function(request, status) {
				configData = $(request.responseXML);
				loadConfig();
			}
		});
	}
	
	this.refresh = function() {
		// make sure we already got a loaded config
		// and no pending profile loads
		if(!configLoaded || loadLock) {
			return;
		}
		
		// lock loading
		loadLock = true;
		
		// select profile placeholders
		profiles = $('.steamprofile[title]');
		
		// are there any profiles to build?
		if(profiles.length == 0) {
			return;
		}

		// store profile id for later usage
		profiles.each(function() {
			var profile = $(this);
			profile.data('profileID', $.trim(profile.attr('title')));
			profile.removeAttr('title');
		});

		// replace placeholders with loading template and make them visible
		profiles.empty().append(loadingTpl);
		
		// load first profile
		loadProfile(0);
	}
	
	this.load = function(profileID) {
		// make sure we already got a loaded config
		// and no pending profile loads
		if(!configLoaded || loadLock) {
			return;
		}
		
		// create profile base
		profile = $('<div class="steamprofile"></div>');
		
		// add loading template
		profile.append(loadingTpl);
		
		// load xml data
		jQuery.ajax({
			type: 'GET',
			url: getXMLProxyURL(profileID),
			dataType: 'xml',
			complete: function(request, status) {
				// build profile and replace placeholder with profile
				profile.empty().append(createProfile($(request.responseXML)));
			}
		});
		
		return profile;
	}
	
	this.isLocked = function() {
		return loadLock;
	}
	
	function getXMLProxyURL(profileID) {
		return basePath + 'xmlproxy.php?id=' + escape(profileID);
	}
	
	function getConfigString(name) {
		return configData.find('vars > var[name="' + name + '"]').text();
	}
	
	function getConfigBool(name) {
		return getConfigString(name).toLowerCase() == 'true';
	}
	
	function loadConfig() {
		showSliderMenu = getConfigBool('slidermenu');
		showGameBanner = getConfigBool('gamebanner');
	
		// set theme stylesheet
		themePath = basePath + 'themes/' + getConfigString('theme') + '/';
		$('head').append('<link rel="stylesheet" type="text/css" href="' + themePath + 'style.css">');
		
		// load templates
		profileTpl = $(configData.find('templates > profile').text());
		loadingTpl = $(configData.find('templates > loading').text());
		errorTpl   = $(configData.find('templates > error').text());
		
		// add theme path to image src
		profileTpl.find('img').attrAppend('src', themePath);
		loadingTpl.find('img').attrAppend('src', themePath);
		errorTpl.find('img').attrAppend('src', themePath);
		
		// we can now unlock the refreshing function
		configLoaded = true;
		
		// start loading profiles
		SteamProfile.refresh();
	}

	function loadProfile(profileIndex) {
		// check if we have loaded all profiles already
		if(profileIndex >= profiles.length) {
			// unlock loading
			loadLock = false;
			return;
		}
		
		var profile = $(profiles[profileIndex++]);
		var profileID = profile.data('profileID');
		
		if(profileCache[profileID] == null) {
			// load xml data
			jQuery.ajax({
				type: 'GET',
				url: getXMLProxyURL(profileID),
				dataType: 'xml',
				complete: function(request, status) {
					// build profile and cache DOM for following IDs
					profileCache[profileID] = createProfile($(request.responseXML));
					// replace placeholder with profile
					profile.empty().append(profileCache[profileID]);
					// load next profile
					loadProfile(profileIndex);
				}
			});
		} else {
			// the profile was build previously, just copy it
			var profileCopy = profileCache[profileID].clone();
			createEvents(profileCopy);
			profile.empty().append(profileCopy);
			// load next profile
			loadProfile(profileIndex);
		}
	}

	function createProfile(profileData) {
		if (profileData.find('profile').length != 0) {
			if (profileData.find('profile > steamID64').text() == '') {
				// the profile doesn't exists yet
				return createError('This user has not yet set up their Steam Community profile.');
			} else {
				// profile data looks good
				var profile = profileTpl.clone();
				var onlineState = profileData.find('profile > onlineState').text();
				
				// set state class, avatar image and name
				profile.find('.sp-badge').addClass('sp-' + onlineState);
				profile.find('.sp-avatar img').attr('src', profileData.find('profile > avatarFull').text());
				profile.find('.sp-info a').append(profileData.find('profile > steamID').text());
				
				// set state message
				if (profileData.find('profile > visibilityState').text() == '1') {
					profile.find('.sp-info').append('This profile is private.');
				} else {
					profile.find('.sp-info').append(profileData.find('profile > stateMessage').text());
				}
				
				// set game background
				if (showGameBanner && profileData.find('profile > inGameInfo > gameLogoSmall').length != 0) {
					profile.css('background-image', 'url(' + profileData.find('profile > inGameInfo > gameLogoSmall').text() + ')');
				} else {
					profile.removeClass('sp-bg-game');
					profile.find('.sp-bg-fade').removeClass('sp-bg-fade');
				}
			}
			
			return profile;
		} else if (profileData.find('response').length != 0) {
			// steam community returned a message
			return createError(profileData.find('response > error').text());
		} else {
			// we got invalid xml data
			return createError('Invalid community data.');
		}
	}
	
	function createEvents(profile) {
		// add events for menu
		profile.find('.sp-handle').click(function() {
			profile.find('.sp-content').toggle(200);
		});
	}

	function createError(message) {
		var errorTmp = errorTpl.clone();
		errorTmp.append(message);	
		return errorTmp;
	}
};





