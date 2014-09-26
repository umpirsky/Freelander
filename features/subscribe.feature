Feature: Email subscribtion
    In order to subscribe
    As a landing page visitor
    I need to be to submit my email address via subscribtion form

  Scenario: Trying to subscribe without email address
    Given I am on the homepage
      And I press "Subscribe"
     Then I should see "The email parameter should include an email, euid, or leid key"

  Scenario: Trying to subscribe with invalid email address
    Given I am on the homepage
      And I fill in "Email" with "umpirsky"
      And I press "Subscribe"
     Then I should see "An email address must contain a single @"

  Scenario: Trying to subscribe with invalid email address
    Given I am on the homepage
      And I fill in "Email" with "umpirsky@gmail"
      And I press "Subscribe"
     Then I should see "The domain portion of the email address is invalid (the portion after the @: gmail)"

  Scenario: Trying to subscribe when already subscribed
    Given I am on the homepage
      And I fill in "Email" with "umpirsky+subscribed@gmail.com"
      And I press "Subscribe"
     Then I should see "umpirsky+subscribed@gmail.com is already subscribed to the list."

  Scenario: Successfully subscribing wth valid email address
    Given I am on the homepage
      And I fill in "Email" with "umpirsky+not-subscribed-yet@gmail.com"
      And I press "Subscribe"
     Then I should see "Thanks for subscribing."
