import { TextField, withStyles } from "@material-ui/core";
import { utcToZonedTime, zonedTimeToUtc } from "date-fns-tz";
import React, { useImperativeHandle } from "react";
import DatePicker from "react-datepicker";
import { ColorNames, palette } from "wrx-ui-kit";

const FullWidthTextfield = withStyles({
    root: {
        width:"100%"
    }
})(TextField);

export const DatePickerControl = React.memo(React.forwardRef(function DatePickerControl(props, ref) {
    const {
        isEditMode,
        readOnly,
        changeHandler,
        onClick,
        runWorkflow,
        label,
        businessObject,
        showTime,
        onChange,
        error
    } = props;

    useImperativeHandle(ref, () => {}, []);

    let date = '';
    let value = props.value;
    if (isEditMode) {
        date = new Date();
    }
    else if (value) {
        date = utcToZonedTime(value, 'UTC');
    }

    if (readOnly) {
        return (
            <React.Fragment>
                <div>
                    <p style= {
                        {
                            color: [palette.palette.grey[ColorNames.Black20], '!important'].join(' '),
                            marginTop: -6,
                            opacity: '70%'
                        }
                    }>
                        {label}
                    </p>
                </div>
                <div style={{marginTop: -13}}>
                    {onClick
                        ? <Link href="#" onClick={() => {
                            if (!isEditMode) {
                                runWorkflow(onClick, { inputData: businessObject });
                            }
                        }}>{date.toString()}</Link>
                        : <div>{date.toString()}</div>
                    }
                </div>
            </React.Fragment>
        );
    }

    return (
        <DatePicker
            style={{ width:"100%" }}
            selected={date}
            showTimeSelect={showTime}
            placeholderText={label}
            customInput={
                <FullWidthTextfield
                    data-cy={"datePickerControl"}
                    error={!!error}
                    helperText={error}
                />
            }
            onChange={(value) => changeHandler(zonedTimeToUtc(value, 'UTC'))}
            wrapperClassName={"full-width"}
            portalId={"root-portal"}
            onBlur={() => {
                if (onChange && !isEditMode) {
                    runWorkflow(onChange, { inputData: businessObject });
                }
            }}
        />
    );
}));