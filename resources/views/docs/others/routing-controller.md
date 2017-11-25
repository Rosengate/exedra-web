# Routing Controller

Exedra by default provides no execute handle to a class based controller like most frameworks do. It used to have one, but because at one point 
it conflicts with the direction of the framework is going to, we decided to deprecate it.

However it has external component you may interested in, called [exedron/routeller](https://github.com/exedron/routeller).

## Introduction
Routeller is an annotation and reflection based anemic routing controller for Exedra.

Writing a lot of `\Closure` for your deep nested routing can get messier and not so IDE-friendly as they grow much bigger. This package is built to tackle the issue and give you a nice routing controller over your routing groups.

The controller is anemic, flattened and incapable of construction, but knows very well about the routing design.

The annotation design is fairly simple, just a @property-value mapping. Nothing much!

## Installation
For installation, just head to the [github](https://github.com/exedron/routeller) page itself.