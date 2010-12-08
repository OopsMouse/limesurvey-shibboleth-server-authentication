<?php

/**
 * Used for testing.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */

//@todo:remove that

$_SERVER['Shib-Application-ID'] = 'default';
$_SERVER['Shib-Session-ID'] = '_abcdefghijklmopqrstuvwxyz1234567890';
$_SERVER['Shib-Identity-Provider'] = 'https://idp/idp/shibboleth';
$_SERVER['Shib-Authentication-Instant'] = '2010-12-06T14:29:47.256Z';
$_SERVER['Shib-Authentication-Method'] = 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport';
$_SERVER['Shib-AuthnContext-Class'] = 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport';
$_SERVER['Shib-EP-Affiliation'] = 'member;staff';
$_SERVER['Shib-EP-Entitlement'] = ' urn:mace:dir:entitlement:common-lib-terms';
$_SERVER['Shib-EP-OrgDN'] = 'dc=unige, dc=ch';
$_SERVER['Shib-InetOrgPerson-employeeNumber'] = '123456789';
$_SERVER['Shib-InetOrgPerson-givenName'] = 'Laurent Alexandre';
$_SERVER['Shib-InetOrgPerson-mail'] = 'Laurent.Opprecht@unige.ch';
$_SERVER['Shib-InetOrgPerson-preferredLanguage'] = 'fr-ch';
$_SERVER['Shib-OrgPerson-postalAddress'] = 'RUE GENERAL-DUFOUR 24$1204 GENEVE$ $ $ $';
$_SERVER['Shib-Person-surname'] = 'Opprecht';
$_SERVER['Shib-SwissEP-CardUID'] = 'xxxxxxxxxxxxxxxxxx';
$_SERVER['Shib-SwissEP-Gender'] = '1';
$_SERVER['Shib-SwissEP-HomeOrganization'] = 'unige.ch';
$_SERVER['Shib-SwissEP-HomeOrganizationType'] = 'university';
$_SERVER['Shib-SwissEP-StaffCategory'] = '300';
$_SERVER['Shib-SwissEP-UniqueID'] = '12345@unige.ch';
$_SERVER['Shib-SwissEP-swissEduPersonStaffCategory'] = '300';

?>
