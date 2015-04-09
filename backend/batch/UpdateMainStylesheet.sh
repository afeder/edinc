#!/bin/sh
#Updates the tool's main CSS stylesheet from the MediaWiki installation at
#wikitech.wikimedia.org. This script has no API and must be run manually.
SCRIPT=$(readlink -f $0)
SCRIPTPATH=`dirname $SCRIPT`
curl -o $SCRIPTPATH/../../public_html/stylesheet/main.css "https://wikitech.wikimedia.org/w/load.php?debug=false&lang=en&modules=ext.gadget.enwp-boxes%7Cext.uls.nojs%7Cext.visualEditor.viewPageTarget.noscript%7Cext.wikihiero%7Cmediawiki.legacy.commonPrint%2Cshared%7Cmediawiki.sectionAnchor%7Cmediawiki.skinning.interface%7Cmediawiki.ui.button%7Cskins.vector.styles&only=styles&skin=vector&*"
