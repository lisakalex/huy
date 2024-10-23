#!/usr/bin/env bash

# Script: gen_css.sh
#
# Description: used to generate the css file from the supplied scss file
# Author: Mark Slater
#
# Version: 1.0.0 - initial version

# Functions
function send_error()
{
    /bin/echo "${0}: Usage error. ${1}"
}

function print_usage()
{
    /bin/echo "NAME: ${0}: Generate the appropriate .css and .map files from supplied sass file"
    /bin/echo "SYNOPSIS"
    /bin/echo "${0} -f <sass file without suffix>"
    /bin/echo "DESCRIPTION"
    /bin/echo "This will generate the file .css and .map used for the web page from the supplied .scss file"
    /bin/echo "-f the scss file name without suffix. A file with same name and .css suffix and .map suffix is created in same directory"
    /bin/echo "-h displays this message"

    exit 0
}

# get and check arguments
while getopts "f:h" OPTIONS
do
    case ${OPTIONS} in
        f ) FILE=${OPTARG}
            ;;
        h ) print_usage
            ;;
        * )
            ;;
    esac
done

# check file supplied
if [ -z ${FILE} ]
then
    send_error "No scss file supplied to convert"
    exit 1
fi

# internal declarations
INFILE="${FILE}.scss"
OUTFILE="${FILE}.css"

# check file exists and name in correct format
if [ ! -f ${INFILE} ]
then
    send_error "Input file ${INFILE} does not exist"
    exit 1
fi

# Generate the css and map files
if [ -f ${OUTFILE} ]
then
    /bin/echo "Archiving old ${OUTFILE} to ${OUTFILE}.bak"
    /bin/mv ${OUTFILE} ${OUTFILE}.bak
fi

/bin/echo "Generating file ${OUTFILE} from ${INFILE}"
/usr/bin/scss --line-comments ${INFILE} > ${OUTFILE}

if [ -f ${OUTFILE} ]
then
    /bin/echo "File ${OUTFILE} generated successfully"
fi
