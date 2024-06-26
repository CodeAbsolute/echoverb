import { usePage } from "@inertiajs/react";

import React, { useEffect } from "react";

const ChatLayout = ({ children }) => {
    const page = usePage();
    const conversations = page.props.conversations;
    const selectedConversation = page.props.selectedConversation;

    console.log("conversations", conversations);
    console.log("selectedConversation", selectedConversation);

    useEffect(() => {
        console.log("inside useEffect");
        Echo.join("online")
            .here((users) => {
                console.log("here: ", users);
            })
            .joining((user) => {
                console.log("joining: ", user);
            })
            .leaving((user) => {
                console.log("leaving: ", user);
            })
            .error((user) => {
                console.error("error: ", user);
            });
    }, []);

    return (
        <>
            ChatLayout
            <div>{children}</div>
        </>
    );
};

export default ChatLayout;
